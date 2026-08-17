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
        $today = Carbon::today()->toDateString();

        // Base query with search & status filters
        $baseQuery = Agenda::query();

        if ($request->filled('search')) {
            $this->applySearchFilter($baseQuery, $request->input('search'));
        }

        if ($request->filled('status')) {
            $baseQuery->where('status', $request->input('status'));
        }

        // Calculate accurate counts for each time tab
        $countAll = (clone $baseQuery)->count();
        $countToday = (clone $baseQuery)->whereDate('date', $today)->count();
        $countUpcoming = (clone $baseQuery)->where('date', '>', $today)->count();
        $countPast = (clone $baseQuery)->where('date', '<', $today)->count();

        // Apply time tab filter and segment-specific ordering
        $timeFilter = $request->input('time_filter', 'all');
        $query = clone $baseQuery;

        if ($timeFilter === 'today') {
            $query->whereDate('date', $today)
                ->orderBy('time_start', 'asc');
        } elseif ($timeFilter === 'upcoming') {
            $query->where('date', '>', $today)
                ->orderBy('date', 'asc')
                ->orderBy('time_start', 'asc');
        } elseif ($timeFilter === 'past') {
            $query->where('date', '<', $today)
                ->orderBy('date', 'desc')
                ->orderBy('time_start', 'desc');
        } else {
            $query->orderBy('date', 'desc')
                ->orderBy('time_start', 'asc');
        }

        $agendas = $query->paginate(10)->withQueryString();

        return view('admin.agenda.index', compact('agendas', 'countAll', 'countToday', 'countUpcoming', 'countPast', 'timeFilter'));
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

    /**
     * Apply intelligent keyword, location, and date search filter.
     */
    protected function applySearchFilter($query, string $search): void
    {
        $search = trim($search);
        $searchLower = strtolower($search);

        $indonesianMonths = [
            'januari' => 1, 'jan' => 1,
            'februari' => 2, 'feb' => 2,
            'maret' => 3, 'mar' => 3,
            'april' => 4, 'apr' => 4,
            'mei' => 5,
            'juni' => 6, 'jun' => 6,
            'juli' => 7, 'jul' => 7,
            'agustus' => 8, 'agt' => 8, 'ags' => 8,
            'september' => 9, 'sep' => 9,
            'oktober' => 10, 'okt' => 10,
            'november' => 11, 'nov' => 11,
            'desember' => 12, 'des' => 12,
        ];

        $query->where(function ($q) use ($search, $searchLower, $indonesianMonths) {
            // 1. Text & generic string matching
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('date', 'like', "%{$search}%");

            // 2. Numerical date matching (e.g. 17-08-2026, 17/08/2026, 17-08)
            if (preg_match('/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})$/', $search, $matches)) {
                $d = sprintf('%04d-%02d-%02d', $matches[3], $matches[2], $matches[1]);
                $q->orWhereDate('date', $d);
            } elseif (preg_match('/^(\d{1,2})[\/\-](\d{1,2})$/', $search, $matches)) {
                $q->orWhere(function ($sub) use ($matches) {
                    $sub->whereDay('date', (int) $matches[1])
                        ->whereMonth('date', (int) $matches[2]);
                });
            }

            // 3. Indonesian verbal date matching (e.g. "17 Agustus 2026", "17 Agustus", "Agustus")
            foreach ($indonesianMonths as $monthName => $monthNum) {
                if (str_contains($searchLower, $monthName)) {
                    if (preg_match('/(\d{1,2})\s+'.preg_quote($monthName, '/').'(?:\s+(\d{4}))?/', $searchLower, $matches)) {
                        $day = (int) $matches[1];
                        $year = isset($matches[2]) ? (int) $matches[2] : null;

                        $q->orWhere(function ($sub) use ($day, $monthNum, $year) {
                            $sub->whereDay('date', $day)->whereMonth('date', $monthNum);
                            if ($year) {
                                $sub->whereYear('date', $year);
                            }
                        });
                    } else {
                        $q->orWhereMonth('date', $monthNum);
                    }
                    break;
                }
            }
        });
    }
}
