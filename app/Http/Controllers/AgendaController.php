<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display the public calendar of events and agenda timeline.
     */
    public function index(Request $request)
    {
        // Parameter bulan dan tahun (default ke bulan & tahun sekarang)
        $month = (int) $request->input('month', Carbon::now()->month);
        $year = (int) $request->input('year', Carbon::now()->year);

        // Validasi bulan
        if ($month < 1 || $month > 12) {
            $month = Carbon::now()->month;
        }

        // Ambil semua agenda pada bulan & tahun tersebut yang statusnya published dan sudah aktif
        $agendas = Agenda::published()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'asc')
            ->orderBy('time_start', 'asc')
            ->get();

        // Nama-nama bulan Indonesia
        $indonesianMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        $monthName = $indonesianMonths[$month];

        // Format tanggal hari ini
        $todayDateString = Carbon::now()->format('Y-m-d');

        // Parameter tanggal terpilih untuk linimasa
        $selectedDateString = $request->input('date');

        // Jika tidak ada tanggal terpilih, default ke hari ini (jika berada di bulan/tahun terpilih) atau tampilkan semua agenda bulan ini
        $timelineTitle = "Agenda Bulan {$monthName} {$year}";
        $timelineAgendas = $agendas;

        if ($selectedDateString) {
            $selectedDate = Carbon::parse($selectedDateString);
            $timelineTitle = 'Agenda untuk tanggal '.$selectedDate->format('d').' '.$indonesianMonths[(int) $selectedDate->format('m')].' '.$selectedDate->format('Y');
            $timelineAgendas = Agenda::published()
                ->whereDate('date', $selectedDateString)
                ->orderBy('time_start', 'asc')
                ->get();
        }

        // --- Perhitungan Kalender Grid (42 Sel) ---
        $firstDayOfMonth = Carbon::create($year, $month, 1);
        $startDayOfWeek = $firstDayOfMonth->dayOfWeek; // 0 (Ahad) s.d 6 (Sabtu)

        $days = [];

        // 1. Hari dari bulan sebelumnya (jika ada sisa kolom di minggu pertama)
        $prevMonth = $month == 1 ? 12 : $month - 1;
        $prevYear = $month == 1 ? $year - 1 : $year;
        $daysInPrevMonth = Carbon::create($prevYear, $prevMonth)->daysInMonth;

        for ($i = $startDayOfWeek - 1; $i >= 0; $i--) {
            $dayNum = $daysInPrevMonth - $i;
            $days[] = [
                'day' => $dayNum,
                'date_string' => sprintf('%04d-%02d-%02d', $prevYear, $prevMonth, $dayNum),
                'is_current_month' => false,
                'has_events' => false,
                'is_today' => false,
            ];
        }

        // 2. Hari dari bulan berjalan
        $daysInMonth = $firstDayOfMonth->daysInMonth;
        $activeDaysWithEvents = $agendas->pluck('date')->map(fn ($d) => $d->format('Y-m-d'))->unique()->toArray();

        for ($dayNum = 1; $dayNum <= $daysInMonth; $dayNum++) {
            $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $dayNum);
            $days[] = [
                'day' => $dayNum,
                'date_string' => $dateStr,
                'is_current_month' => true,
                'has_events' => in_array($dateStr, $activeDaysWithEvents),
                'is_today' => ($dateStr === $todayDateString),
            ];
        }

        // 3. Hari dari bulan berikutnya (untuk memenuhi 42 sel kalender)
        $nextMonth = $month == 12 ? 1 : $month + 1;
        $nextYear = $month == 12 ? $year + 1 : $year;
        $remainingCells = 42 - count($days);

        for ($dayNum = 1; $dayNum <= $remainingCells; $dayNum++) {
            $days[] = [
                'day' => $dayNum,
                'date_string' => sprintf('%04d-%02d-%02d', $nextYear, $nextMonth, $dayNum),
                'is_current_month' => false,
                'has_events' => false,
                'is_today' => false,
            ];
        }

        return view('agenda', compact(
            'days',
            'month',
            'year',
            'monthName',
            'agendas',
            'timelineTitle',
            'timelineAgendas',
            'selectedDateString',
            'indonesianMonths'
        ));
    }
}
