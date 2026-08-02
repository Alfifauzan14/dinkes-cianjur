<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Models\Agenda;
use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $homeBeritas = Berita::where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();

    $today = Carbon::today();
    $selectedDateStr = request('agenda_date');
    $selectedDate = $today;

    if ($selectedDateStr) {
        try {
            $selectedDate = Carbon::parse($selectedDateStr)->startOfDay();
            if ($selectedDate->isFuture()) {
                $selectedDate = $today;
            }
        } catch (\Exception $e) {
            $selectedDate = $today;
        }
    }

    $selectedDateString = $selectedDate->format('Y-m-d');

    // Fetch agendas on that selected date (published and active only)
    $homeAgendas = Agenda::published()
        ->whereDate('date', $selectedDateString)
        ->orderBy('time_start', 'asc')
        ->get();

    // Format current date label for the view
    $indonesianMonthsShort = [
        1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
        5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
        9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER'
    ];
    $currentDateLabel = $selectedDate->format('d') . ' ' . $indonesianMonthsShort[$selectedDate->format('n')] . ' ' . $selectedDate->format('Y');

    $prevDate = $selectedDate->copy()->subDay()->format('Y-m-d');
    $nextDate = $selectedDate->copy()->addDay()->format('Y-m-d');
    $canNavigateNext = $selectedDate->lt($today);

    $homeGaleris = App\Models\Galeri::orderBy('created_at', 'desc')->take(5)->get();
    $profile = App\Models\Profile::first();

    return view('welcome', compact(
        'homeBeritas', 
        'homeAgendas', 
        'currentDateLabel', 
        'prevDate', 
        'nextDate', 
        'canNavigateNext',
        'homeGaleris',
        'profile'
    ));
});

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/profil/tentang-dinkes', function () {
    $profile = App\Models\Profile::first();
    return view('profil', compact('profile'));
})->name('profil.tentang');

Route::get('/ppid', function () {
    return view('ppid');
})->name('ppid');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');

/* --- Satu Data Kesehatan Routes --- */
Route::get('/satu-data/statistik', function () {
    return view('statistik');
})->name('satudata.statistik');

Route::get('/satu-data/laporan', function () {
    return view('laporan');
})->name('satudata.laporan');

Route::get('/satu-data/regulasi', function () {
    return view('regulasi');
})->name('satudata.regulasi');

/* --- Labkesda & Faskes Routes --- */
Route::get('/media', function () {
    $galeris = App\Models\Galeri::orderBy('created_at', 'desc')->paginate(12)->withQueryString();
    return view('media', compact('galeris'));
})->name('media');

Route::get('/faskes', function () {
    return view('faskes');
})->name('faskes');

Route::get('/labkesda', function () {
    return view('labkesda');
})->name('labkesda');

/* --- Admin Login Routes (Double-Gatekeeper) --- */
Route::get('/dinkes-login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/dinkes-gatekeeper', [AuthController::class, 'verifyGatekeeper'])->name('gatekeeper.verify');
Route::post('/dinkes-login', [AuthController::class, 'login'])->name('login.post');
Route::post('/dinkes-logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::resource('/admin/berita', App\Http\Controllers\Admin\BeritaController::class, [
    'names' => [
        'index' => 'admin.berita.index',
        'create' => 'admin.berita.create',
        'store' => 'admin.berita.store',
        'edit' => 'admin.berita.edit',
        'update' => 'admin.berita.update',
        'destroy' => 'admin.berita.destroy',
    ],
])->middleware('auth');

Route::get('/admin/agenda/import', [App\Http\Controllers\Admin\AgendaController::class, 'importForm'])->middleware('auth')->name('admin.agenda.import_form');
Route::post('/admin/agenda/import', [App\Http\Controllers\Admin\AgendaController::class, 'import'])->middleware('auth')->name('admin.agenda.import');

Route::resource('/admin/agenda', App\Http\Controllers\Admin\AgendaController::class, [
    'names' => [
        'index' => 'admin.agenda.index',
        'create' => 'admin.agenda.create',
        'store' => 'admin.agenda.store',
        'edit' => 'admin.agenda.edit',
        'update' => 'admin.agenda.update',
        'destroy' => 'admin.agenda.destroy',
    ],
])->middleware('auth');

Route::resource('/admin/galeri', App\Http\Controllers\Admin\GaleriController::class, [
    'names' => [
        'index' => 'admin.galeri.index',
        'create' => 'admin.galeri.create',
        'store' => 'admin.galeri.store',
        'edit' => 'admin.galeri.edit',
        'update' => 'admin.galeri.update',
        'destroy' => 'admin.galeri.destroy',
    ],
])->middleware('auth');

Route::get('/admin/profil', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->middleware('auth')->name('admin.profil.edit');
Route::put('/admin/profil', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->middleware('auth')->name('admin.profil.update');

Route::get('/layanan-terpadu', function () {
    return view('layanan-terpadu');
})->name('layanan-terpadu');

Route::get('/cianjur-bebas-stunting', function () {
    return view('stunting');
})->name('stunting');

Route::get('/kesehatan-ibu-anak', function () {
    return view('kia');
})->name('kia');
