<?php

use App\Exports\WilayahPdfExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdoController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\GenusController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FamiliController;
use App\Http\Controllers\ClassisController;
use App\Http\Controllers\SpesiesController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\VegetasiController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;


Route::group(['middleware' => 'guest'], function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('main');

    Route::get('/login', [LoginController::class, 'index'])->name('account.login');
    Route::get('/register', [LoginController::class, 'register'])->name('account.register');
    Route::post('/processRegister', [LoginController::class, 'processRegister'])->name('account.processRegister');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');

});

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
            Route::get('export/excel', 'exportExcel')->name('export.excel');
            Route::get('export/pdf', 'exportPdf')->name('export.pdf');
        });

        Route::group(['prefix' => 'vegetasi', 'as' => 'vegetasi.', 'controller' => VegetasiController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{vegetasi}', 'show')->name('show');
            Route::put('{vegetasi}', 'update')->name('update');
            Route::delete('{vegetasi}', 'destroy')->name('delete');
            Route::get('export/excel', 'exportExcel')->name('export.excel');
            Route::get('export/pdf', 'exportPdf')->name('export.pdf');
        });

        Route::group(['prefix' => 'kelas', 'as' => 'kelas.', 'controller' => ClassisController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{classis}', 'show')->name('show');
            Route::put('{classis}', 'update')->name('update');
            Route::delete('{classis}', 'destroy')->name('delete');
            Route::get('export/excel', 'exportExcel')->name('export.excel');
            Route::get('export/pdf', 'exportPdf')->name('export.pdf');
        });

        Route::group(['prefix' => 'ordo', 'as' => 'ordo.', 'controller' => OrdoController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{ordo}', 'show')->name('show');
            Route::put('{ordo}', 'update')->name('update');
            Route::delete('{ordo}', 'destroy')->name('delete');
            Route::get('export/excel', 'exportExcel')->name('export.excel');
            Route::get('export/pdf', 'exportPdf')->name('export.pdf');
        });

        Route::group(['prefix' => 'famili', 'as' => 'famili.', 'controller' => FamiliController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{famili}', 'show')->name('show');
            Route::put('{famili}', 'update')->name('update');
            Route::delete('{famili}', 'destroy')->name('delete');
            Route::get('export/excel', 'exportExcel')->name('export.excel');
            Route::get('export/pdf', 'exportPdf')->name('export.pdf');
        });

        Route::group(['prefix' => 'genus', 'as' => 'genus.', 'controller' => GenusController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{genus}', 'show')->name('show');
            Route::put('{genus}', 'update')->name('update');
            Route::delete('{genus}', 'destroy')->name('delete');
            Route::get('export/excel', 'exportExcel')->name('export.excel');
            Route::get('export/pdf', 'exportPdf')->name('export.pdf');
        });

        Route::group(['prefix' => 'spesies', 'as' => 'spesies.', 'controller' => SpesiesController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('{spesies}', 'show')->name('show');
            Route::put('{spesies}', 'update')->name('update');
            Route::delete('{spesies}', 'destroy')->name('delete');
            Route::get('export/excel', 'exportExcel')->name('export.excel');
            Route::get('export/pdf', 'exportPdf')->name('export.pdf');
        });

        Route::get('peta', [PetaController::class, 'index'])->name('peta.index');

    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('account.logout');

});

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function(){
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::put('dashboard/{user}',[AdminDashboardController::class,'update'])->name('admin.dashboard.update');
        Route::delete('dashboard/{user}',[AdminDashboardController::class,'destroy'])->name('admin.dashboard.delete');
    });
});



