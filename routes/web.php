<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataKriteriaController;
use App\Http\Controllers\DataMotorController;
use App\Http\Controllers\KriteriaHargaController;
use App\Http\Controllers\KriteriaJarakController;
use App\Http\Controllers\KriteriaKondisiController;
use App\Http\Controllers\KriteriaTahunController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'dashboard'])->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // motor
        Route::get('/data-motor', [DataMotorController::class, 'index'])->name('data-motor');
        Route::get('/tambah-motor', [DataMotorController::class, 'create'])->name('tambah-motor');
        Route::post('/tambah-motor', [DataMotorController::class, 'store'])->name('tambah-motor');
        Route::get('/update-data-motor/{id}', [DataMotorController::class, 'edit'])->name('update-data-motor');
        Route::put('/update-data-motor', [DataMotorController::class, 'update'])->name('update-data-motor');
        Route::delete('/delete-motor/{id}', [DataMotorController::class, 'destroy'])->name('delete-motor');

        // data kriteria
        Route::get('/update-data-kriteria/{id}', [DataKriteriaController::class, 'edit'])->name('update-data-kriteria');
        Route::put('/update-data-kriteria', [DataKriteriaController::class, 'update'])->name('update-data-kriteria');

        // kriteria
        Route::get('/kriteria', [KriteriaHargaController::class, 'index'])->name('kriteria');

        // kriteria Harga
        Route::get('/kriteria-harga', [KriteriaHargaController::class, 'create'])->name('kriteria-harga');
        Route::post('/kriteria-harga', [KriteriaHargaController::class, 'store'])->name('kriteria-harga');
        Route::get('/update-kriteria-harga/{id}', [KriteriaHargaController::class, 'edit'])->name('update-kriteria-harga');
        Route::put('/update-kriteria-harga', [KriteriaHargaController::class, 'update'])->name('update-kriteria-harga');
        Route::delete('/delete-kriteria-harga/{id}', [KriteriaHargaController::class, 'destroy'])->name('delete-kriteria-harga');

        // Kriteria Kondisi
        Route::get('/kriteria-kondisi', [KriteriaKondisiController::class, 'create'])->name('kriteria-kondisi');
        Route::post('/kriteria-kondisi', [KriteriaKondisiController::class, 'store'])->name('kriteria-kondisi');
        Route::get('/update-kriteria-kondisi/{id}', [KriteriaKondisiController::class, 'edit'])->name('update-kriteria-kondisi');
        Route::put('/update-kriteria-kondisi', [KriteriaKondisiController::class, 'update'])->name('update-kriteria-kondisi');
        Route::delete('/delete-kriteria-kondisi/{id}', [KriteriaKondisiController::class, 'destroy'])->name('delete-kriteria-kondisi');


        // Kriteria Jarak
        Route::get('/kriteria-jarak', [KriteriaJarakController::class, 'create'])->name('kriteria-jarak');
        Route::post('/kriteria-jarak', [KriteriaJarakController::class, 'store'])->name('kriteria-jarak');
        Route::get('/update-kriteria-jarak/{id}', [KriteriaJarakController::class, 'edit'])->name('update-kriteria-jarak');
        Route::put('/update-kriteria-jarak', [KriteriaJarakController::class, 'update'])->name('update-kriteria-jarak');
        Route::delete('/delete-kriteria-jarak/{id}', [KriteriaJarakController::class, 'destroy'])->name('delete-kriteria-jarak');


        // Kriteria Tahun
        Route::get('/kriteria-tahun', [KriteriaTahunController::class, 'create'])->name('kriteria-tahun');
        Route::post('/kriteria-tahun', [KriteriaTahunController::class, 'store'])->name('kriteria-tahun');
        Route::get('/update-kriteria-tahun/{id}', [KriteriaTahunController::class, 'edit'])->name('update-kriteria-tahun');
        Route::put('/update-kriteria-tahun', [KriteriaTahunController::class, 'update'])->name('update-kriteria-tahun');
        Route::delete('/delete-kriteria-tahun/{id}', [KriteriaTahunController::class, 'destroy'])->name('delete-kriteria-tahun');

        // Customer
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    });

    Route::get('/datas-motor', [LandingController::class, 'dataMotor'])->name('datas-motor');
    Route::get('/pengaturan-bobot', [LandingController::class, 'aturBobot'])->name('pengaturan-bobot');
    Route::get('/update-bobot/{id}', [LandingController::class, 'editBobot'])->name('update-bobot');
    Route::put('/update-bobot', [LandingController::class, 'updateBobot'])->name('update-bobot');
    Route::get('/perhitungan', [LandingController::class, 'perhitungan'])->name('perhitungan');
    Route::get('/tambah-alternatif', [LandingController::class, 'tambahAlternatif'])->name('tambah-alternatifs');
    Route::post('/tambah-alternatif/{id}', [LandingController::class, 'storeAlternatif'])->name('tambah-alternatif');
    Route::delete('/truncate-alternatif', [LandingController::class, 'truncateAlternatif'])->name('truncate-alternatif');
    Route::get('/cetak-pdf', [PdfController::class, 'generatePDF'])->name('cetak-pdf');

    Route::post('/tambah-alternatiff', [LandingController::class, 'storeAlternatifs'])->name('tambah-alternatiff');


    Route::delete('/delete-alternatif/{id}', [LandingController::class, 'destroyAlternatif'])->name('delete-alternatif');
});

require __DIR__ . '/auth.php';
