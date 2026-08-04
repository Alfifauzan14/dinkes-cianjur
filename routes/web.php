<?php

use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\LabkesdaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananTerpaduController;
use App\Http\Controllers\Admin\PagodaSehatController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RegulasiController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProgramKesehatanController;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\LabkesdaCategory;
use App\Models\LabkesdaSetting;
use App\Models\Laporan;
use App\Models\HomeInfoCard;
use App\Models\HomeSocialLink;
use App\Models\LayananTerpadu;
use App\Models\PagodaSehatCard;
use App\Models\Profile;
use App\Models\Regulasi;
use App\Models\StatistikSetting;
use App\Models\StuntingRecord;
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
        } catch (Exception $e) {
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
        9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER',
    ];
    $currentDateLabel = $selectedDate->format('d').' '.$indonesianMonthsShort[$selectedDate->format('n')].' '.$selectedDate->format('Y');

    $prevDate = $selectedDate->copy()->subDay()->format('Y-m-d');
    $nextDate = $selectedDate->copy()->addDay()->format('Y-m-d');
    $canNavigateNext = true;

    $homeGaleris = Galeri::orderBy('created_at', 'desc')->take(5)->get();
    $profile = Profile::first();

    $pagodaCards = PagodaSehatCard::orderBy('order_index')->get();

    $infoCards = HomeInfoCard::orderBy('order_index')->get();

    $socialLinks = HomeSocialLink::orderBy('order_index')->get();

    return view('welcome', compact(
        'homeBeritas',
        'homeAgendas',
        'currentDateLabel',
        'prevDate',
        'nextDate',
        'canNavigateNext',
        'homeGaleris',
        'profile',
        'pagodaCards',
        'infoCards',
        'socialLinks'
    ));
});

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/profil/tentang-dinkes', function () {
    $profile = Profile::first();

    return view('profil', compact('profile'));
})->name('profil.tentang');

Route::get('/ppid', function () {
    return view('ppid');
})->name('ppid');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');

/* --- Satu Data Kesehatan Routes --- */
Route::get('/satu-data/statistik', function () {
    $setting = StatistikSetting::firstOrCreate(
        ['id' => 1],
        [
            'status_badge' => 'Data Riil Semester I 2026',
            'stat_1_num' => '47',
            'stat_1_badge' => '100% Aktif!',
            'stat_1_caption' => 'Seluruhnya Terakreditasi Paripurna',
            'stat_2_num' => '8',
            'stat_2_badge' => 'Mitra BPJS',
            'stat_2_caption' => '4 RSUD Pemda + 4 RS Swasta',
            'stat_3_num' => '3,820',
            'stat_3_badge' => 'Tersertifikasi',
            'stat_3_caption' => 'Dokter, Perawat, Bidan, & Apoteker',
            'stat_4_num' => '94.8%',
            'stat_4_badge' => '+3.2% YoY',
            'stat_4_caption' => 'Target Nasional 2026: 95.0%',
            'stunting_title' => 'Tren Penurunan Prevalensi Stunting',
            'stunting_subtitle' => 'Target Daerah Cianjur 2026: <10%',
            'stunting_trend_badge' => 'Tren Positif',
            'stunting_footer_note' => 'Penurunan sebesar -8.4% dalam 2 tahun melalui Program Pendampingan Keluarga Terpadu.',
            'nakes_data' => [
                ['name' => 'Perawat Kesehatan', 'value' => '1,604 (42%)', 'width' => 42],
                ['name' => 'Bidan Desa & Puskesmas', 'value' => '1,184 (31%)', 'width' => 31],
                ['name' => 'Dokter Umum & Spesialis', 'value' => '573 (15%)', 'width' => 15],
                ['name' => 'Apoteker & Tenaga Kefarmasian', 'value' => '459 (12%)', 'width' => 12],
            ],
            'sebaran_data' => [
                ['name' => 'Zonasi Selatan', 'value' => '17 Puskesmas (36%)', 'width' => 36],
                ['name' => 'Zonasi Utara', 'value' => '16 Puskesmas (34%)', 'width' => 34],
                ['name' => 'Zonasi Tengah', 'value' => '14 Puskesmas (30%)', 'width' => 30],
            ],
        ]
    );

    $stuntingRecords = StuntingRecord::orderBy('year', 'asc')->get();
    $maxRate = $stuntingRecords->max('rate') ?: 1;

    return view('statistik', compact('setting', 'stuntingRecords', 'maxRate'));
})->name('satudata.statistik');

Route::get('/satu-data/laporan', function () {
    $laporans = Laporan::orderBy('release_date', 'desc')->get();

    return view('laporan', compact('laporans'));
})->name('satudata.laporan');

Route::get('/satu-data/regulasi', function () {
    $regulasis = Regulasi::orderBy('year', 'desc')->orderBy('created_at', 'desc')->paginate(6);

    return view('regulasi', compact('regulasis'));
})->name('satudata.regulasi');

/* --- Labkesda & Faskes Routes --- */
Route::get('/media', function () {
    $galeris = Galeri::orderBy('created_at', 'desc')->paginate(12)->withQueryString();

    return view('media', compact('galeris'));
})->name('media');

Route::get('/faskes', function () {
    return view('faskes');
})->name('faskes');

Route::get('/labkesda', function () {
    $settings = LabkesdaSetting::firstOrCreate(['id' => 1]);
    $categories = LabkesdaCategory::with('items')->orderBy('order_index')->get();

    return view('labkesda', compact('settings', 'categories'));
})->name('labkesda');

/* --- Admin Labkesda Routes --- */
Route::get('/admin/labkesda/settings', [LabkesdaController::class, 'editSettings'])->middleware('auth')->name('admin.labkesda.settings.edit');
Route::put('/admin/labkesda/settings', [LabkesdaController::class, 'updateSettings'])->middleware('auth')->name('admin.labkesda.settings.update');
Route::put('/admin/labkesda/{labkesda}/move', [LabkesdaController::class, 'move'])->middleware('auth')->name('admin.labkesda.move');

Route::resource('/admin/labkesda', LabkesdaController::class, [
    'names' => [
        'index' => 'admin.labkesda.index',
        'create' => 'admin.labkesda.create',
        'store' => 'admin.labkesda.store',
        'edit' => 'admin.labkesda.edit',
        'update' => 'admin.labkesda.update',
        'destroy' => 'admin.labkesda.destroy',
    ],
])->middleware('auth');

/* --- Admin Pagoda Sehat Routes --- */
Route::put('/admin/pagodasehat/{pagodasehat}/move', [PagodaSehatController::class, 'move'])->middleware('auth')->name('admin.pagodasehat.move');

Route::resource('/admin/pagodasehat', PagodaSehatController::class, [
    'names' => [
        'index' => 'admin.pagodasehat.index',
        'create' => 'admin.pagodasehat.create',
        'store' => 'admin.pagodasehat.store',
        'edit' => 'admin.pagodasehat.edit',
        'update' => 'admin.pagodasehat.update',
        'destroy' => 'admin.pagodasehat.destroy',
    ],
])->middleware('auth');

/* --- Admin Home Content Routes (edit only) --- */
Route::get('/admin/home-content', [HomeContentController::class, 'index'])->middleware('auth')->name('admin.home-content.index');
Route::get('/admin/home-content/{homeInfoCard}/edit', [HomeContentController::class, 'edit'])->middleware('auth')->name('admin.home-content.edit');
Route::put('/admin/home-content/{homeInfoCard}', [HomeContentController::class, 'update'])->middleware('auth')->name('admin.home-content.update');
Route::put('/admin/home-content/social/update', [HomeContentController::class, 'updateSocialLinks'])->middleware('auth')->name('admin.home-content.social.update');

/* --- Admin Login Routes (Double-Gatekeeper) --- */
Route::get('/dinkes-login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/dinkes-gatekeeper', [AuthController::class, 'verifyGatekeeper'])->name('gatekeeper.verify');
Route::post('/dinkes-login', [AuthController::class, 'login'])->name('login.post');
Route::post('/dinkes-logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::resource('/admin/berita', App\Http\Controllers\Admin\BeritaController::class, [
    'parameters' => [
        'berita' => 'berita',
    ],
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

Route::resource('/admin/galeri', GaleriController::class, [
    'names' => [
        'index' => 'admin.galeri.index',
        'create' => 'admin.galeri.create',
        'store' => 'admin.galeri.store',
        'edit' => 'admin.galeri.edit',
        'update' => 'admin.galeri.update',
        'destroy' => 'admin.galeri.destroy',
    ],
])->middleware('auth');

Route::get('/admin/profil', [ProfileController::class, 'edit'])->middleware('auth')->name('admin.profil.edit');
Route::put('/admin/profil', [ProfileController::class, 'update'])->middleware('auth')->name('admin.profil.update');

Route::get('/admin/satu-data/statistik', [StatistikController::class, 'edit'])->middleware('auth')->name('admin.satudata.statistik.edit');
Route::put('/admin/satu-data/statistik', [StatistikController::class, 'update'])->middleware('auth')->name('admin.satudata.statistik.update');
Route::get('/admin/satu-data/statistik/import', [StatistikController::class, 'importForm'])->middleware('auth')->name('admin.satudata.statistik.import');
Route::post('/admin/satu-data/statistik/import', [StatistikController::class, 'importCsv'])->middleware('auth')->name('admin.satudata.statistik.import.post');
Route::get('/admin/satu-data/statistik/template', [StatistikController::class, 'downloadTemplate'])->middleware('auth')->name('admin.satudata.statistik.template');

Route::resource('/admin/satu-data/laporan', LaporanController::class, [
    'names' => [
        'index' => 'admin.laporan.index',
        'create' => 'admin.laporan.create',
        'store' => 'admin.laporan.store',
        'edit' => 'admin.laporan.edit',
        'update' => 'admin.laporan.update',
        'destroy' => 'admin.laporan.destroy',
    ],
])->middleware('auth');

Route::resource('/admin/satu-data/regulasi', RegulasiController::class, [
    'names' => [
        'index' => 'admin.regulasi.index',
        'create' => 'admin.regulasi.create',
        'store' => 'admin.regulasi.store',
        'edit' => 'admin.regulasi.edit',
        'update' => 'admin.regulasi.update',
        'destroy' => 'admin.regulasi.destroy',
    ],
])->middleware('auth');

Route::resource('/admin/layanan-terpadu', LayananTerpaduController::class, [
    'names' => [
        'index' => 'admin.layanan.index',
        'create' => 'admin.layanan.create',
        'store' => 'admin.layanan.store',
        'edit' => 'admin.layanan.edit',
        'update' => 'admin.layanan.update',
        'destroy' => 'admin.layanan.destroy',
    ],
])->middleware('auth');

Route::resource('/admin/program-kesehatan', App\Http\Controllers\Admin\ProgramKesehatanController::class, [
    'names' => [
        'index' => 'admin.program-kesehatan.index',
        'create' => 'admin.program-kesehatan.create',
        'store' => 'admin.program-kesehatan.store',
        'edit' => 'admin.program-kesehatan.edit',
        'update' => 'admin.program-kesehatan.update',
        'destroy' => 'admin.program-kesehatan.destroy',
    ],
])->middleware('auth');

Route::get('/layanan-terpadu', function () {
    $wargaServices = LayananTerpadu::where('type', 'Warga')->get();
    $faskesServices = LayananTerpadu::where('type', 'Faskes')->get();
    $nakesServices = LayananTerpadu::where('type', 'Nakes')->get();

    return view('layanan-terpadu', compact('wargaServices', 'faskesServices', 'nakesServices'));
})->name('layanan-terpadu');

Route::get('/program/{slug}', [ProgramKesehatanController::class, 'show'])->name('program.show');

Route::get('/cianjur-bebas-stunting', function () {
    return redirect()->route('program.show', 'cianjur-bebas-stunting');
})->name('stunting');

Route::get('/kesehatan-ibu-anak', function () {
    return redirect()->route('program.show', 'kesehatan-ibu-anak');
})->name('kia');
