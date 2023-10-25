<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SpaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/admin/auth/{any}', [SpaController::class, 'index'])->where('any', '.*')->name('lvs.auth');
Route::get('/admin', [SpaController::class, 'index'])->name('lvs.home');
//Route::get('/admin/{any}', [SpaController::class, 'index'])->where('any', '.*')->name('lvs.home');


Route::get('/', function () {
    return view('admin.app');
});
