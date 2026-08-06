<?php

use App\Http\Controllers\Admin\FaskesController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\HeaderSettingController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\JenisFaskesController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\LabkesdaController as AdminLabkesdaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LayananTerpaduController as AdminLayananTerpaduController;
use App\Http\Controllers\Admin\PagodaSehatController;
use App\Http\Controllers\Admin\PpidController as AdminPpidController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\RegulasiController;
use App\Http\Controllers\Admin\SettingFooterController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FaskesController as PublicFaskesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IkmController;
use App\Http\Controllers\LabkesdaController;
use App\Http\Controllers\LayananTerpaduController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PPIDController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramKesehatanController;
use App\Http\Controllers\SatuDataController;
use Illuminate\Support\Facades\Route;

/* --- Public Halaman Utama & Info Routes --- */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/profil/tentang-dinkes', [ProfileController::class, 'index'])->name('profil.tentang');
Route::get('/profil/visi-misi', [ProfileController::class, 'visiMisi'])->name('profil.visi-misi');
Route::get('/profil/struktur-organisasi', [ProfileController::class, 'strukturOrganisasi'])->name('profil.struktur-organisasi');
Route::get('/ppid', [PPIDController::class, 'index'])->name('ppid');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
Route::get('/api/agenda-by-date', [HomeController::class, 'agendaByDate'])->name('agenda.by_date');

/* --- Satu Data Kesehatan Routes --- */
Route::get('/satu-data/statistik', [SatuDataController::class, 'statistik'])->name('satudata.statistik');
Route::get('/satu-data/laporan', [SatuDataController::class, 'laporan'])->name('satudata.laporan');
Route::get('/satu-data/laporan/{laporan}/view', [SatuDataController::class, 'viewLaporan'])->name('satudata.laporan.view');
Route::get('/satu-data/laporan/{laporan}/download', [SatuDataController::class, 'downloadLaporan'])->name('satudata.laporan.download');
Route::get('/satu-data/regulasi', [SatuDataController::class, 'regulasi'])->name('satudata.regulasi');
Route::get('/satu-data/regulasi/{regulasi}/view', [SatuDataController::class, 'viewRegulasi'])->name('satudata.regulasi.view');
Route::get('/satu-data/regulasi/{regulasi}/download', [SatuDataController::class, 'downloadRegulasi'])->name('satudata.regulasi.download');

/* --- Indeks Kepuasan Masyarakat (IKM) --- */
Route::get('/ikm', [IkmController::class, 'index'])->name('ikm');
Route::post('/ikm', [IkmController::class, 'store'])->name('ikm.store');

/* --- Labkesda & Faskes Routes --- */
Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::get('/faskes', [PublicFaskesController::class, 'index'])->name('faskes');
Route::get('/labkesda', [LabkesdaController::class, 'index'])->name('labkesda');

/* --- Layanan Terpadu & Program Kesehatan Routes --- */
Route::get('/layanan-terpadu', [LayananTerpaduController::class, 'index'])->name('layanan-terpadu');
Route::get('/program/{slug}', [ProgramKesehatanController::class, 'show'])->name('program.show');

Route::get('/cianjur-bebas-stunting', function () {
    return redirect()->route('program.show', 'cianjur-bebas-stunting');
})->name('stunting');

Route::get('/kesehatan-ibu-anak', function () {
    return redirect()->route('program.show', 'kesehatan-ibu-anak');
})->name('kia');

/* --- Admin Labkesda Routes --- */
Route::get('/admin/labkesda/settings', [AdminLabkesdaController::class, 'editSettings'])->middleware('auth')->name('admin.labkesda.settings.edit');
Route::put('/admin/labkesda/settings', [AdminLabkesdaController::class, 'updateSettings'])->middleware('auth')->name('admin.labkesda.settings.update');
Route::put('/admin/labkesda/{labkesda}/move', [AdminLabkesdaController::class, 'move'])->middleware('auth')->name('admin.labkesda.move');
Route::post('/admin/labkesda/reorder', [AdminLabkesdaController::class, 'reorder'])->middleware('auth')->name('admin.labkesda.reorder');

Route::resource('/admin/labkesda', AdminLabkesdaController::class, [
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
Route::post('/admin/pagodasehat/reorder', [PagodaSehatController::class, 'reorder'])->middleware('auth')->name('admin.pagodasehat.reorder');

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

/* --- Admin Dashboard & Management Routes --- */
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/admin/setting-footer', [SettingFooterController::class, 'edit'])->middleware('auth')->name('admin.settingfooter.edit');
Route::put('/admin/setting-footer', [SettingFooterController::class, 'update'])->middleware('auth')->name('admin.settingfooter.update');

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

Route::resource('/admin/faskes', FaskesController::class, [
    'names' => [
        'index' => 'admin.faskes.index',
        'create' => 'admin.faskes.create',
        'store' => 'admin.faskes.store',
        'edit' => 'admin.faskes.edit',
        'update' => 'admin.faskes.update',
        'destroy' => 'admin.faskes.destroy',
    ],
])->middleware('auth');

Route::get('/admin/faskes-export', [FaskesController::class, 'exportCsv'])->middleware('auth')->name('admin.faskes.export');
Route::post('/admin/faskes-import', [FaskesController::class, 'importCsv'])->middleware('auth')->name('admin.faskes.import');

Route::resource('/admin/jenis-faskes', JenisFaskesController::class, [
    'names' => [
        'index' => 'admin.jenis-faskes.index',
        'store' => 'admin.jenis-faskes.store',
        'update' => 'admin.jenis-faskes.update',
        'destroy' => 'admin.jenis-faskes.destroy',
    ],
])->middleware('auth');

Route::resource('/admin/kecamatan', KecamatanController::class, [
    'names' => [
        'index' => 'admin.kecamatan.index',
        'store' => 'admin.kecamatan.store',
        'update' => 'admin.kecamatan.update',
        'destroy' => 'admin.kecamatan.destroy',
    ],
])->middleware('auth');

Route::resource('/admin/headers', HeaderSettingController::class, [
    'only' => ['index', 'update'],
    'names' => [
        'index' => 'admin.headers.index',
        'update' => 'admin.headers.update',
    ],
])->middleware('auth');

Route::get('/admin/ppid', [AdminPpidController::class, 'edit'])->middleware('auth')->name('admin.ppid.edit');
Route::put('/admin/ppid', [AdminPpidController::class, 'update'])->middleware('auth')->name('admin.ppid.update');

Route::get('/admin/profil', [AdminProfileController::class, 'edit'])->middleware('auth')->name('admin.profil.edit');
Route::put('/admin/profil', [AdminProfileController::class, 'update'])->middleware('auth')->name('admin.profil.update');

Route::get('/admin/satu-data/statistik', [StatistikController::class, 'edit'])->middleware('auth')->name('admin.satudata.statistik.edit');
Route::put('/admin/satu-data/statistik', [StatistikController::class, 'update'])->middleware('auth')->name('admin.satudata.statistik.update');
// Route::get('/admin/satu-data/statistik/import', [StatistikController::class, 'importForm'])->middleware('auth')->name('admin.satudata.statistik.import');
// Route::post('/admin/satu-data/statistik/import', [StatistikController::class, 'importCsv'])->middleware('auth')->name('admin.satudata.statistik.import.post');
// Route::get('/admin/satu-data/statistik/template', [StatistikController::class, 'downloadTemplate'])->middleware('auth')->name('admin.satudata.statistik.template');

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

Route::resource('/admin/layanan-terpadu', AdminLayananTerpaduController::class, [
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

Route::get('/admin/ikm', [App\Http\Controllers\Admin\IkmController::class, 'index'])->middleware('auth')->name('admin.ikm.index');

/* --- Admin Kategori Routes --- */
Route::get('/admin/kategori', [KategoriController::class, 'index'])->middleware('auth')->name('admin.kategori.index');
Route::post('/admin/kategori', [KategoriController::class, 'store'])->middleware('auth')->name('admin.kategori.store');
Route::put('/admin/kategori/{kategori}', [KategoriController::class, 'update'])->middleware('auth')->name('admin.kategori.update');
Route::delete('/admin/kategori/{kategori}', [KategoriController::class, 'destroy'])->middleware('auth')->name('admin.kategori.destroy');

/* --- Admin Manajemen Pengguna Routes --- */
Route::resource('/admin/users', App\Http\Controllers\Admin\UserController::class, [
    'names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ],
])->middleware('auth');

Route::post('/admin/users/{user}/reset-password', [App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->middleware('auth')->name('admin.users.reset-password');
Route::post('/admin/users/{user}/toggle-active', [App\Http\Controllers\Admin\UserController::class, 'toggleActive'])->middleware('auth')->name('admin.users.toggle-active');
