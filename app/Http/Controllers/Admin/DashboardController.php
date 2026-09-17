<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Faskes;
use App\Models\IkmRating;
use App\Models\Laporan;
use App\Models\PpidKeberatan;
use App\Models\PpidPermohonan;
use App\Models\Regulasi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the main admin dashboard with summary metrics.
     */
    public function index(): View
    {
        $totalBerita = Berita::count();
        $totalAgenda = Agenda::count();
        $totalLaporan = Laporan::count();
        $totalRegulasi = Regulasi::count();
        $totalFaskes = Faskes::count();

        // PPID Stats
        $ppidPendingCount = PpidPermohonan::where('status', 'pending')->count();
        $ppidApprovedCount = PpidPermohonan::where('status', 'disetujui')->count();
        $ppidRejectedCount = PpidPermohonan::where('status', 'ditolak')->count();
        $totalPpid = PpidPermohonan::count();
        $totalKeberatan = PpidKeberatan::count();

        // IKM Stats
        $ikmTotal = IkmRating::count();
        $ikmSangatPuas = IkmRating::where('rating', 'sangat_puas')->count();
        $ikmPuas = IkmRating::where('rating', 'puas')->count();
        $ikmCukup = IkmRating::where('rating', 'cukup')->count();
        $ikmKurang = IkmRating::where('rating', 'kurang')->count();

        // Recent pending PPID requests needing attention
        $pendingPermohonans = PpidPermohonan::where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // If no pending, show latest 5 of any status
        $latestPermohonans = $pendingPermohonans->isNotEmpty()
            ? $pendingPermohonans
            : PpidPermohonan::latest()->take(5)->get();

        // Recent Berita & Agenda
        $recentBerita = Berita::latest()->take(5)->get();
        $upcomingAgenda = Agenda::where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalAgenda',
            'totalLaporan',
            'totalRegulasi',
            'totalFaskes',
            'ppidPendingCount',
            'ppidApprovedCount',
            'ppidRejectedCount',
            'totalPpid',
            'totalKeberatan',
            'ikmTotal',
            'ikmSangatPuas',
            'ikmPuas',
            'ikmCukup',
            'ikmKurang',
            'latestPermohonans',
            'recentBerita',
            'upcomingAgenda'
        ));
    }
}
