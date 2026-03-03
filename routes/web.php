<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FeedbackController;

Route::get('/', [LandingController::class, 'index'])->name('beranda');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::view('/portal', 'portal')->name('portal');

// Profil Routes
Route::prefix('profil')->name('profil.')->group(function () {
    Route::view('/visi-misi', 'pages.profil.visi-misi')->name('visi-misi');
    Route::view('/tujuan-sasaran', 'pages.profil.tujuan-sasaran')->name('tujuan-sasaran');
    Route::view('/tupoksi', 'pages.profil.tupoksi')->name('tupoksi');
    Route::view('/aparatur', 'pages.profil.aparatur')->name('aparatur');
    Route::view('/motto', 'pages.profil.motto')->name('motto');
    Route::view('/penghargaan', 'pages.profil.penghargaan')->name('penghargaan');
    Route::view('/struktur', 'pages.profil.struktur')->name('struktur');
});

// Berita Routes
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

// Regulasi Routes
Route::prefix('regulasi')->name('regulasi.')->group(function () {
    Route::view('/undang-undang', 'pages.regulasi.undang-undang')->name('undang-undang');
    Route::view('/peraturan-menteri', 'pages.regulasi.peraturan-menteri')->name('peraturan-menteri');
    Route::view('/peraturan-daerah', 'pages.regulasi.peraturan-daerah')->name('peraturan-daerah');
    Route::view('/peraturan-bupati', 'pages.regulasi.peraturan-bupati')->name('peraturan-bupati');
    Route::view('/sk-bupati', 'pages.regulasi.sk-bupati')->name('sk-bupati');
    Route::view('/sk-kepala', 'pages.regulasi.sk-kepala')->name('sk-kepala');
    Route::view('/lain-lain', 'pages.regulasi.lain-lain')->name('lain-lain');
});

// Dokumen Routes
Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::view('/renstra', 'pages.dokumen.renstra')->name('renstra');
    Route::view('/renja', 'pages.dokumen.renja')->name('renja');
    Route::view('/dpa', 'pages.dokumen.dpa')->name('dpa');
    Route::view('/iku', 'pages.dokumen.iku')->name('iku');
    Route::view('/sop', 'pages.dokumen.sop')->name('sop');
    Route::view('/sakip', 'pages.dokumen.sakip')->name('sakip');
    Route::view('/rkpd', 'pages.dokumen.rkpd')->name('rkpd');
    Route::view('/rpjpd', 'pages.dokumen.rpjpd')->name('rpjpd');
    Route::view('/rpjmd', 'pages.dokumen.rpjmd')->name('rpjmd');
});

// PPID Routes
Route::prefix('ppid')->name('ppid.')->group(function () {
    Route::view('/berkala', 'pages.ppid.berkala')->name('berkala');
    Route::view('/serta-merta', 'pages.ppid.serta-merta')->name('serta-merta');
    Route::view('/setiap-saat', 'pages.ppid.setiap-saat')->name('setiap-saat');
    Route::view('/dikecualikan', 'pages.ppid.dikecualikan')->name('dikecualikan');
    Route::view('/permohonan', 'pages.ppid.permohonan')->name('permohonan');
});

// Layanan Routes
Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::view('/pengaduan', 'pages.layanan.pengaduan')->name('pengaduan');
    Route::view('/cek-status', 'pages.layanan.cek-status')->name('cek-status');
    Route::view('/survey', 'pages.layanan.survey')->name('survey');
});
