<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\HomeInfoCard;
use App\Models\HomeSocialLink;
use App\Models\Infografis;
use App\Models\PagodaSehatCard;
use App\Models\Profile;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        $currentDateLabel = Str::upper($selectedDate->locale('id')->translatedFormat('d F Y'));

        $prevDate = $selectedDate->copy()->subDay()->format('Y-m-d');
        $nextDate = $selectedDate->copy()->addDay()->format('Y-m-d');
        $canNavigateNext = true;

        $homeGaleris = Galeri::orderBy('created_at', 'desc')->take(10)->get();
        $homeInfografis = Infografis::orderBy('created_at', 'desc')->take(4)->get();
        $profile = Profile::first();

        $pagodaCards = PagodaSehatCard::orderBy('order_index')->get();
        $infoCards = HomeInfoCard::orderBy('order_index')->get();
        $socialLinks = HomeSocialLink::orderBy('order_index')->get();

        return view('landing-page', compact(
            'homeBeritas',
            'homeAgendas',
            'currentDateLabel',
            'prevDate',
            'nextDate',
            'canNavigateNext',
            'homeGaleris',
            'homeInfografis',
            'profile',
            'pagodaCards',
            'infoCards',
            'socialLinks'
        ));
    }

    /**
     * Fetch agendas by date via AJAX.
     */
    public function agendaByDate(Request $request): JsonResponse
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

        $currentDateLabel = Str::upper($selectedDate->locale('id')->translatedFormat('d F Y'));

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
