<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdoController;
use App\Http\Controllers\GenusController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FamiliController;
use App\Http\Controllers\ClassisController;
use App\Http\Controllers\SpesiesController;
use App\Http\Controllers\WilayahController;
use App\Exports\WilayahPdfExport;

// Route::group(['middleware' => 'guest'], function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [LoginController::class, 'index'])->name('account.login');
    Route::get('/register', [LoginController::class, 'register'])->name('account.register');
    Route::post('/processRegister', [LoginController::class, 'processRegister'])->name('account.processRegister');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->name('account.logout');
// });

// Authenticated middleware
Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', function () {
            return view('dashboard.index', [
                'page_title' => 'Dashboard'
            ]);
        })->name('index');

        Route::group(['prefix' => 'wilayah', 'as' => 'wilayah.', 'controller' => WilayahController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{wilayah}', 'show')->name('show');
            Route::put('{wilayah}', 'update')->name('update');
            Route::delete('{wilayah}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'kelas', 'as' => 'kelas.', 'controller' => ClassisController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{classis}', 'show')->name('show');
            Route::put('{classis}', 'update')->name('update');
            Route::delete('{classis}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'ordo', 'as' => 'ordo.', 'controller' => OrdoController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{ordo}', 'show')->name('show');
            Route::put('{ordo}', 'update')->name('update');
            Route::delete('{ordo}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'famili', 'as' => 'famili.', 'controller' => FamiliController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{famili}', 'show')->name('show');
            Route::put('{famili}', 'update')->name('update');
            Route::delete('{famili}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'genus', 'as' => 'genus.', 'controller' => GenusController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{genus}', 'show')->name('show');
            Route::put('{genus}', 'update')->name('update');
            Route::delete('{genus}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'spesies', 'as' => 'spesies.', 'controller' => SpesiesController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{spesies}', 'show')->name('show');
            Route::put('{spesies}', 'update')->name('update');
            Route::delete('{spesies}', 'destroy')->name('delete');
        });

        Route::get('peta', function () {
            return view('dashboard.peta', [
                'page_title' => 'Peta Vegetasi Wilayah'
            ]);
        })->name('peta');
    });
    Route::get('dashboard/classis/export/excel', [ClassisController::class, 'exportExcel'])->name('dashboard.kelas.export.excel');
    Route::get('dashboard/wilayah/export/excel', [WilayahController::class, 'export'])->name('dashboard.wilayah.export.excel');
    Route::get('dashboard/ordo/export/excel', [OrdoController::class, 'exportExcel'])->name('dashboard.ordo.export.excel');
    Route::get('dashboard/famili/export/excel', [FamiliController::class, 'exportExcel'])->name('dashboard.famili.export.excel');
    Route::get('dashboard/genus/export/excel', [GenusController::class, 'exportExcel'])->name('dashboard.genus.export.excel');
    Route::get('/dashboard/spesies/export/excel', [SpesiesController::class, 'exportExcel'])->name('dashboard.spesies.export.excel');
    Route::get('/dashboard/wilayah/export/pdf', [WilayahController::class, 'exportPdf'])->name('dashboard.wilayah.export.pdf');
    Route::get('/dashboard/classis/export/pdf', [ClassisController::class, 'exportPdf'])->name('dashboard.kelas.export.pdf');
    Route::get('dashboard/ordo/export/pdf', [OrdoController::class, 'exportPdf'])->name('dashboard.ordo.export.pdf');
    Route::get('/dashboard/famili/export/pdf', [FamiliController::class, 'exportPdf'])->name('dashboard.famili.export.pdf');
    Route::get('/dashboard/genus/export/pdf', [GenusController::class, 'exportPdf'])->name('dashboard.genus.export.pdf');
    Route::get('/dashboard/spesies/export/pdf', [SpesiesController::class, 'exportPdf'])->name('dashboard.spesies.export.pdf');
});

