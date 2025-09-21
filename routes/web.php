<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole; // Import middleware class

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Route dashboard utama yang redirect sesuai role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'pakar') {
            return redirect()->route('pakar.dashboard');
        } elseif ($role === 'pengguna') {  // sesuaikan dengan role 'pengguna' bukan 'user'
            return redirect()->route('dashboard.user');
        }
        abort(403, 'Role tidak dikenali');
    })->name('dashboard');

    // Dashboard pakar, pakai middleware CheckRole langsung (tanpa daftar di Kernel)
    Route::get('/dashboard/pakar', function () {
        return view('pakar.dashboard');
    })->middleware(CheckRole::class . ':pakar')->name('pakar.dashboard');

    // Dashboard pengguna
    Route::get('/dashboard/user', function () {
        return view('user.dashboard');
    })->middleware(CheckRole::class . ':pengguna')->name('dashboard.user');
});

use App\Http\Controllers\DiagnosisController;

// Middleware auth supaya user harus login terlebih dahulu
Route::middleware('auth')->group(function () {

    // 1. Form data diri
    Route::get('/diagnosa/data', [DiagnosisController::class, 'showDataForm'])
        ->name('diagnosa.data_form');

    Route::post('/diagnosa/data', [DiagnosisController::class, 'storeData'])
        ->name('diagnosa.store_data');

    // 2. Form pilih permasalahan kulit
    Route::get('/diagnosa/permasalahan', [DiagnosisController::class, 'showPermasalahanForm'])
        ->name('diagnosa.permasalahan_form');

    // 3. Form pilih penyebab berdasarkan permasalahan yang dipilih
    Route::post('/diagnosa/penyebab', [DiagnosisController::class, 'showPenyebabForm'])
        ->name('diagnosa.penyebab_form');

    // 4. Proses diagnosa CF
    Route::post('/diagnosa/proses', [DiagnosisController::class, 'prosesDiagnosa'])
        ->name('diagnosa.proses');

    // 5. Diagnosa ulang
    Route::get('/diagnosa/ulang', [DiagnosisController::class, 'diagnosaUlang'])
        ->name('diagnosa.ulang');
});

use App\Http\Controllers\KonsultasiController;

// Routes untuk konsultasi user
Route::middleware('auth')->group(function () {
    // Form permintaan konsultasi
    Route::get('/konsultasi/create', [KonsultasiController::class, 'create'])
        ->name('konsultasi.create');

    // Simpan permintaan konsultasi
    Route::post('/konsultasi', [KonsultasiController::class, 'store'])
        ->name('konsultasi.store');

    // Status konsultasi
    Route::get('/konsultasi/{id}/status', [KonsultasiController::class, 'status'])
        ->name('konsultasi.status');

    // Daftar konsultasi user
    Route::get('/konsultasi', [KonsultasiController::class, 'userKonsultasi'])
        ->name('konsultasi.user');
});

// Routes untuk pakar konsultasi
Route::middleware(['auth', CheckRole::class . ':pakar'])->prefix('pakar')->name('pakar.')->group(function () {
    // Daftar konsultasi untuk pakar
    Route::get('/konsultasi', [KonsultasiController::class, 'pakarIndex'])
        ->name('konsultasi.index');

    // Detail konsultasi
    Route::get('/konsultasi/{id}', [KonsultasiController::class, 'pakarShow'])
        ->name('konsultasi.show');

    // Konfirmasi konsultasi
    Route::post('/konsultasi/{id}/konfirmasi', [KonsultasiController::class, 'pakarKonfirmasi'])
        ->name('konsultasi.konfirmasi');

    // Selesaikan konsultasi
    Route::post('/konsultasi/{id}/selesai', [KonsultasiController::class, 'pakarSelesai'])
        ->name('konsultasi.selesai');

    // Batalkan konsultasi
    Route::post('/konsultasi/{id}/batal', [KonsultasiController::class, 'pakarBatal'])
        ->name('konsultasi.batal');
});

use App\Http\Controllers\PakarController;

Route::get('pakar/user', [PakarController::class, 'user'])->name('pakar.user');
Route::get('/dashboard/pakar', [PakarController::class, 'dashboard'])->name('pakar.dashboard');
Route::resource('pakar/pakar', PakarController::class)->except(['show']);

use App\Http\Controllers\PenyebabController;

Route::prefix('pakar')->name('pakar.')->group(function () {
    Route::resource('penyebab', PenyebabController::class);
});

use App\Http\Controllers\KategoriKipiController;

Route::prefix('pakar')->name('pakar.')->group(function () {
    Route::resource('kategori_kipi', KategoriKipiController::class);
});

use App\Http\Controllers\PengetahuanController;

Route::prefix('pakar')->name('pakar.')->group(function () {
    Route::get('/pengetahuan', [PengetahuanController::class, 'index'])->name('pengetahuan.index');
    Route::get('/pengetahuan/create', [PengetahuanController::class, 'create'])->name('pengetahuan.create');
    Route::post('/pengetahuan', [PengetahuanController::class, 'store'])->name('pengetahuan.store');
    Route::resource('pengetahuan', PengetahuanController::class)->except(['show']);
});

use App\Http\Controllers\PermasalahanKulitController;

Route::prefix('pakar')->name('pakar.')->group(function () {
    Route::resource('permasalahan_kulit', PermasalahanKulitController::class);
});
