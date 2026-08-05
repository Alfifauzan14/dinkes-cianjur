<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Agenda::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $timeFilter = $request->input('time_filter', 'all');
        $today = \Carbon\Carbon::today()->toDateString();
        if ($timeFilter === 'upcoming') {
            $query->where('date', '>', $today);
        } elseif ($timeFilter === 'today') {
            $query->whereDate('date', $today);
        } elseif ($timeFilter === 'past') {
            $query->where('date', '<', $today);
        }

        $agendas = $query->orderBy('date', 'desc')
            ->orderBy('time_start', 'asc')
            ->paginate(10);

        return view('admin.agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time_start' => 'required|string|max:50',
            'time_end' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:published,draft',
        ]);

        Agenda::create($request->all());

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda kegiatan berhasil dijadwalkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time_start' => 'required|string|max:50',
            'time_end' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:published,draft',
        ]);

        $agenda->update($request->all());

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda kegiatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda kegiatan berhasil dihapus!');
    }

    /**
     * Show the CSV import form.
     */
    public function importForm()
    {
        return view('admin.agenda.import');
    }

    /**
     * Handle the CSV import post request.
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|max:2048',
        ]);

        $file = $request->file('csv_file');

        if ($file->getClientOriginalExtension() !== 'csv') {
            return redirect()->back()->withErrors(['csv_file' => 'Berkas harus berupa file format CSV (.csv)']);
        }

        $path = $file->getRealPath();
        $handle = fopen($path, 'r');
        if (! $handle) {
            return redirect()->back()->withErrors(['csv_file' => 'Gagal membuka berkas CSV.']);
        }

        // Read first line to detect delimiter (, or ;)
        $firstLine = fgets($handle);
        rewind($handle);

        $delimiter = ',';
        if (strpos($firstLine, ';') !== false && strpos($firstLine, ',') === false) {
            $delimiter = ';';
        } elseif (strpos($firstLine, ';') !== false && strpos($firstLine, ',') !== false) {
            $commaCount = substr_count($firstLine, ',');
            $semicolonCount = substr_count($firstLine, ';');
            if ($semicolonCount > $commaCount) {
                $delimiter = ';';
            }
        }

        // Read headers and normalize
        $header = fgetcsv($handle, 1000, $delimiter);
        if (! $header) {
            fclose($handle);

            return redirect()->back()->withErrors(['csv_file' => 'Berkas CSV kosong atau tidak valid.']);
        }

        $header = array_map(function ($h) {
            $h = preg_replace('/[\x{FEFF}\x{200B}]/u', '', $h);

            return strtolower(trim($h));
        }, $header);

        // Map column names dynamically (supporting English & Indonesian)
        $titleIndex = array_search('title', $header);
        if ($titleIndex === false) {
            $titleIndex = array_search('judul', $header);
        }
        if ($titleIndex === false) {
            $titleIndex = array_search('nama', $header);
        }

        $dateIndex = array_search('date', $header);
        if ($dateIndex === false) {
            $dateIndex = array_search('tanggal', $header);
        }

        $timeStartIndex = array_search('time_start', $header);
        if ($timeStartIndex === false) {
            $timeStartIndex = array_search('waktu_mulai', $header);
        }

        $timeEndIndex = array_search('time_end', $header);
        if ($timeEndIndex === false) {
            $timeEndIndex = array_search('waktu_selesai', $header);
        }

        $locationIndex = array_search('location', $header);
        if ($locationIndex === false) {
            $locationIndex = array_search('lokasi', $header);
        }
        if ($locationIndex === false) {
            $locationIndex = array_search('tempat', $header);
        }

        $descriptionIndex = array_search('description', $header);
        if ($descriptionIndex === false) {
            $descriptionIndex = array_search('deskripsi', $header);
        }
        if ($descriptionIndex === false) {
            $descriptionIndex = array_search('keterangan', $header);
        }

        $statusIndex = array_search('status', $header);

        if ($titleIndex === false || $dateIndex === false || $timeStartIndex === false || $timeEndIndex === false || $locationIndex === false) {
            fclose($handle);

            return redirect()->back()->withErrors([
                'csv_file' => 'Format kolom CSV tidak sesuai. Pastikan memiliki kolom wajib: Judul/Title, Tanggal/Date, Waktu Mulai/Time Start, Waktu Selesai/Time End, Lokasi/Location.',
            ]);
        }

        $importedCount = 0;
        $rowNumber = 1;
        $errors = [];

        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            $rowNumber++;

            // Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            $title = isset($row[$titleIndex]) ? trim($row[$titleIndex]) : '';
            $dateVal = isset($row[$dateIndex]) ? trim($row[$dateIndex]) : '';
            $timeStart = isset($row[$timeStartIndex]) ? trim($row[$timeStartIndex]) : '';
            $timeEnd = isset($row[$timeEndIndex]) ? trim($row[$timeEndIndex]) : '';
            $location = isset($row[$locationIndex]) ? trim($row[$locationIndex]) : '';
            $description = ($descriptionIndex !== false && isset($row[$descriptionIndex])) ? trim($row[$descriptionIndex]) : null;
            $status = ($statusIndex !== false && isset($row[$statusIndex])) ? strtolower(trim($row[$statusIndex])) : 'published';

            if (empty($title)) {
                $errors[] = "Baris {$rowNumber}: Judul tidak boleh kosong.";

                continue;
            }

            $parsedDate = null;
            if (! empty($dateVal)) {
                try {
                    $parsedDate = Carbon::parse($dateVal)->format('Y-m-d');
                } catch (\Exception $e) {
                    $errors[] = "Baris {$rowNumber}: Format tanggal '{$dateVal}' tidak valid. Gunakan format YYYY-MM-DD.";

                    continue;
                }
            } else {
                $errors[] = "Baris {$rowNumber}: Tanggal tidak boleh kosong.";

                continue;
            }

            if (empty($timeStart) || empty($timeEnd)) {
                $errors[] = "Baris {$rowNumber}: Waktu mulai dan selesai tidak boleh kosong.";

                continue;
            }

            if (empty($location)) {
                $errors[] = "Baris {$rowNumber}: Lokasi tidak boleh kosong.";

                continue;
            }

            if (! in_array($status, ['published', 'draft'])) {
                $status = 'published';
            }

            Agenda::create([
                'title' => $title,
                'date' => $parsedDate,
                'time_start' => $timeStart,
                'time_end' => $timeEnd,
                'location' => $location,
                'description' => $description,
                'status' => $status,
            ]);

            $importedCount++;
        }

        fclose($handle);

        if (count($errors) > 0) {
            $msg = "Berhasil mengimpor {$importedCount} agenda.";
            if ($importedCount === 0) {
                return redirect()->route('admin.agenda.index')->withErrors($errors);
            }

            return redirect()->route('admin.agenda.index')->with('success', $msg)->withErrors($errors);
        }

        return redirect()->route('admin.agenda.index')->with('success', "Berhasil mengimpor {$importedCount} agenda kegiatan!");
    }
}
