<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faskes;
use Illuminate\Http\Request;

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
        $kecamatans = Faskes::select('kecamatan')->distinct()->orderBy('kecamatan')->pluck('kecamatan');

        return view('admin.faskes.index', compact('faskes', 'kecamatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kecamatans = $this->getKecamatanList();

        return view('admin.faskes.create', compact('kecamatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Rumah Sakit,Puskesmas',
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
    public function edit(Faskes $faskes)
    {
        $kecamatans = $this->getKecamatanList();

        return view('admin.faskes.edit', compact('faskes', 'kecamatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faskes $faskes)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Rumah Sakit,Puskesmas',
            'kecamatan' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:50',
            'jam_operasional' => 'nullable|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'layanan' => 'nullable|string|max:255',
            'akreditasi' => 'nullable|string|max:255',
        ]);

        $faskes->update($request->only([
            'name', 'type', 'kecamatan', 'address', 'phone',
            'jam_operasional', 'lat', 'lng', 'layanan', 'akreditasi',
        ]));

        return redirect()->route('admin.faskes.index')->with('success', 'Faskes berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faskes $faskes)
    {
        $faskes->delete();

        return redirect()->route('admin.faskes.index')->with('success', 'Faskes berhasil dihapus!');
    }

    /**
     * Get sorted kecamatan list.
     */
    private function getKecamatanList(): array
    {
        return [
            'Agrabinta',
            'Campaka',
            'Campakamulya',
            'Cibeber',
            'Cibinong',
            'Cidaun',
            'Cijati',
            'Cikalongkulon',
            'Cilaku',
            'Ciranjang',
            'Cugenang',
            'Gekbrong',
            'Haurwangi',
            'Kadupandak',
            'Karangtengah',
            'Leles',
            'Mande',
            'Naringgul',
            'Pacet',
            'Pagelaran',
            'Pasirkuda',
            'Sindangbarang',
            'Sukanagara',
            'Sukaluyu',
            'Sukaresmi',
            'Takokak',
            'Tanggeung',
            'Warungkondang',
        ];
    }
}
