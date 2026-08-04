<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Profile;
use App\Models\PagodaSehatCard;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home/welcome page.
     */
    public function index(Request $request): View
    {
        $homeBeritas = Berita::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $today = Carbon::today();
        $selectedDateStr = $request->query('agenda_date');
        $selectedDate = $today;

        if ($selectedDateStr) {
            try {
                $selectedDate = Carbon::parse($selectedDateStr)->startOfDay();
            } catch (Exception $e) {
                $selectedDate = $today;
            }
        }

        $selectedDateString = $selectedDate->format('Y-m-d');

        $homeAgendas = Agenda::published()
            ->whereDate('date', $selectedDateString)
            ->orderBy('time_start', 'asc')
            ->get();

        $indonesianMonthsShort = [
            1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
            5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
            9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER',
        ];
        $currentDateLabel = $selectedDate->format('d').' '.$indonesianMonthsShort[$selectedDate->format('n')].' '.$selectedDate->format('Y');

        $prevDate = $selectedDate->copy()->subDay()->format('Y-m-d');
        $nextDate = $selectedDate->copy()->addDay()->format('Y-m-d');
        $canNavigateNext = true;

        $homeGaleris = Galeri::orderBy('created_at', 'desc')->take(5)->get();
        $profile = Profile::first();
        
        $pagodaCards = PagodaSehatCard::orderBy('order_index')->get();

        return view('welcome', compact(
            'homeBeritas',
            'homeAgendas',
            'currentDateLabel',
            'prevDate',
            'nextDate',
            'canNavigateNext',
            'homeGaleris',
            'profile',
            'pagodaCards'
        ));
    }

    /**
     * Fetch agendas by date via AJAX.
     */
    public function agendaByDate(Request $request): \Illuminate\Http\JsonResponse
    {
        $today = Carbon::today();
        $selectedDateStr = $request->query('agenda_date');
        $selectedDate = $today;

        if ($selectedDateStr) {
            try {
                $selectedDate = Carbon::parse($selectedDateStr)->startOfDay();
            } catch (Exception $e) {
                $selectedDate = $today;
            }
        }

        $selectedDateString = $selectedDate->format('Y-m-d');

        $homeAgendas = Agenda::published()
            ->whereDate('date', $selectedDateString)
            ->orderBy('time_start', 'asc')
            ->get(['id', 'title', 'time_start', 'time_end', 'location', 'description']);

        $indonesianMonthsShort = [
            1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
            5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
            9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER',
        ];
        $currentDateLabel = $selectedDate->format('d').' '.$indonesianMonthsShort[$selectedDate->format('n')].' '.$selectedDate->format('Y');

        $prevDate = $selectedDate->copy()->subDay()->format('Y-m-d');
        $nextDate = $selectedDate->copy()->addDay()->format('Y-m-d');

        return response()->json([
            'success' => true,
            'currentDateLabel' => $currentDateLabel,
            'prevDate' => $prevDate,
            'nextDate' => $nextDate,
            'agendas' => $homeAgendas,
        ]);
    }
}
