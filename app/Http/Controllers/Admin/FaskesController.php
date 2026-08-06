<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faskes;
use App\Models\JenisFaskes;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Faskes::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('kecamatan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kecamatan') && $request->input('kecamatan') !== 'Semua') {
            $query->where('kecamatan', $request->input('kecamatan'));
        }

        if ($request->filled('type') && $request->input('type') !== 'Semua') {
            $query->where('type', $request->input('type'));
        }

        $faskes = $query->orderBy('type')->orderBy('name')->paginate(15);

        // Fetch dynamic filter options from DB
        $kecamatans = Kecamatan::orderBy('name')->get();
        $types = JenisFaskes::orderBy('name')->get();

        return view('admin.faskes.index', compact('faskes', 'kecamatans', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kecamatans = Kecamatan::orderBy('name')->get();
        $types = JenisFaskes::orderBy('name')->get();

        return view('admin.faskes.create', compact('kecamatans', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:50',
            'jam_operasional' => 'nullable|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'layanan' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:255',
        ]);

        Faskes::create($request->only([
            'name', 'type', 'kecamatan', 'address', 'phone',
            'jam_operasional', 'lat', 'lng', 'layanan', 'akreditasi',
        ]));

        return redirect()->route('admin.faskes.index')->with('success', 'Faskes berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faskes $faske)
    {
        $kecamatans = Kecamatan::orderBy('name')->get();
        $types = JenisFaskes::orderBy('name')->get();

        return view('admin.faskes.edit', compact('faske', 'kecamatans', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faskes $faske)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:50',
            'jam_operasional' => 'nullable|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'layanan' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:255',
        ]);

        $faske->update($request->only([
            'name', 'type', 'kecamatan', 'address', 'phone',
            'jam_operasional', 'lat', 'lng', 'layanan', 'akreditasi',
        ]));

        return redirect()->route('admin.faskes.index')->with('success', 'Faskes berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faskes $faske)
    {
        $faske->delete();

        return redirect()->route('admin.faskes.index')->with('success', 'Faskes berhasil dihapus!');
    }

    /**
     * Export all Faskes data as CSV.
     */
    public function exportCsv()
    {
        $faskes = Faskes::all();
        $csvFileName = 'faskes_export_'.date('Ymd_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$csvFileName.'"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($faskes) {
            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file, [
                'name',
                'type',
                'kecamatan',
                'address',
                'phone',
                'jam_operasional',
                'lat',
                'lng',
                'layanan',
                'akreditasi',
            ]);

            foreach ($faskes as $row) {
                fputcsv($file, [
                    $row->name,
                    $row->type,
                    $row->kecamatan,
                    $row->address,
                    $row->phone,
                    $row->jam_operasional,
                    $row->lat,
                    $row->lng,
                    $row->layanan,
                    $row->akreditasi,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Import Faskes data from uploaded CSV.
     */
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:4096',
        ]);

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();

        $fileHandle = fopen($filePath, 'r');
        $header = fgetcsv($fileHandle, 1000, ',');

        if (! $header || count($header) < 6) {
            fclose($fileHandle);

            return redirect()->back()->with('error', 'Format CSV tidak valid. Harus mengandung kolom minimal: name, type, kecamatan, address, lat, lng.');
        }

        // Clean headers (remove BOM or spaces)
        $header = array_map(function ($h) {
            return trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h));
        }, $header);

        $rowCount = 0;
        while (($row = fgetcsv($fileHandle, 1000, ',')) !== false) {
            if (count($row) < count($header)) {
                continue;
            }

            $data = array_combine($header, array_slice($row, 0, count($header)));

            if (empty($data['name']) || empty($data['type']) || empty($data['kecamatan']) || empty($data['address'])) {
                continue;
            }

            // Clean data
            $name = trim($data['name']);
            $type = trim($data['type']);
            $kecamatan = trim($data['kecamatan']);
            $address = trim($data['address']);
            $phone = trim($data['phone'] ?? '');
            $jamOperasional = trim($data['jam_operasional'] ?? '');
            $lat = (float) ($data['lat'] ?? 0);
            $lng = (float) ($data['lng'] ?? 0);
            $layanan = trim($data['layanan'] ?? '');
            $akreditasi = trim($data['akreditasi'] ?? '');

            // Auto-create type if not exists
            JenisFaskes::firstOrCreate(['name' => $type]);

            // Auto-create kecamatan if not exists
            Kecamatan::firstOrCreate(['name' => $kecamatan]);

            // Update or create Faskes record
            Faskes::updateOrCreate(
                ['name' => $name, 'kecamatan' => $kecamatan],
                [
                    'type' => $type,
                    'address' => $address,
                    'phone' => $phone ?: null,
                    'jam_operasional' => $jamOperasional ?: null,
                    'lat' => $lat,
                    'lng' => $lng,
                    'layanan' => $layanan ?: null,
                    'akreditasi' => $akreditasi ?: null,
                ]
            );

            $rowCount++;
        }

        fclose($fileHandle);

        return redirect()->route('admin.faskes.index')
            ->with('success', "$rowCount data Faskes berhasil diimpor.");
    }
}
