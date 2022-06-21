<?php

use App\Http\Controllers\ArquivoReceitaController;
use App\Http\Controllers\DespesaRecorrenteController;
use App\Http\Controllers\DropboxController;
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    Route::put('/change/data', [App\Http\Controllers\HomeController::class, 'changeData'])->name('changeData');

    Route::post('/receita', [ReceitaController::class, 'create'])->name('receita');
    Route::put('/receita', [ReceitaController::class, 'update'])->name('receita');

    Route::post('/despesa/recorrente', [DespesaRecorrenteController::class, 'create'])->name('despesaRecorrente');
    Route::get('/despesa/recorrente', [DespesaRecorrenteController::class, 'index'])->name('despesaRecorrente');
    Route::put('/despesa/recorrente', [DespesaRecorrenteController::class, 'update'])->name('despesaRecorrente');
    Route::delete('/despesa/recorrente/{id}', [DespesaRecorrenteController::class, 'delete'])->name('deleteDespesaRecorrente');

    /* Arquivos Receita */
    Route::post('/file/receita/anexar', [ArquivoReceitaController::class, 'create']); // Anexa o arquivo de receita;
    Route::get('/file/receita/{id}', [ArquivoReceitaController::class, 'get']); // Abre o arquivo;
    Route::get('/file/receita/list/{id}', [ArquivoReceitaController::class, 'list']); // Lista todos os arquivos respectivos à receita;


});
