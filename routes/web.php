<?php

use App\Http\Controllers\DespesaRecorrenteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function (){ return view('auth.login'); });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/despesa/recorrente', [DespesaRecorrenteController::class, 'index'])->name('despesaRecorrente');
    Route::post('/despesa/recorrente', [DespesaRecorrenteController::class, 'create'])->name('despesaRecorrente');
    Route::DELETE('/despesa/recorrente/{id}', [DespesaRecorrenteController::class, 'delete'])->name('deleteDespesaRecorrente');

    //Route::get('/despesa/parcelada', [DespesaParceladaController::class, 'index'])->name('despesaParcelada');
});


