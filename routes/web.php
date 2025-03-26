<?php

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\TelemarketingController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::redirect('/enviarForm', '/home');

Route::get('/home', function () {
    return view('home');
});

// Usuário

Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
Route::get('/show-user', [UserController::class, 'show'])->name('user.show');
Route::get('/edit-user', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user', [UserController::class, 'update'])->name('user.update');
Route::delete('/destroy-user', [UserController::class, 'destroy'])->name('user.destroy');

// Funcionários
Route::get('index-funcionario', [FuncionarioController::class, 'index'])->name('funcionario.index');
Route::get('create-funcionario', [FuncionarioController::class, 'create'])->name('funcionario.create');
Route::get('store-funcionario', [FuncionarioController::class, 'store'])->name('funcionario.store');
Route::get('show-funcionario', [FuncionarioController::class, 'show'])->name('funcionario.show');
Route::get('edit-funcionario', [FuncionarioController::class, 'edit'])->name('funcionario.edit');
Route::get('update-funcionario', [FuncionarioController::class, 'update'])->name('funcionario.update');
Route::get('destroy-funcionario', [FuncionarioController::class, 'destroy'])->name('funcionario.destroy');

// Atendimentos
Route::get('index-atendimento', [AtendimentoController::class, 'index'])->name('atendimento.index');
Route::get('create-atendimento', [AtendimentoController::class, 'create'])->name('atendimento.create');
Route::get('store-atendimento', [AtendimentoController::class, 'store'])->name('atendimento.store');
Route::get('show-atendimento', [AtendimentoController::class, 'show'])->name('atendimento.show');
Route::get('edit-atendimento', [AtendimentoController::class, 'edit'])->name('atendimento.edit');
Route::get('update-atendimento', [AtendimentoController::class, 'update'])->name('atendimento.update');
Route::get('destroy-atendimento', [AtendimentoController::class, 'destroy'])->name('atendimento.destroy');

// Telemarketing
Route::get('index-telemarketing', [TelemarketingController::class, 'index'])->name('telemarketing.index');
Route::get('create-telemarketing', [TelemarketingController::class, 'create'])->name('telemarketing.create');
Route::get('store-telemarketing', [TelemarketingController::class, 'store'])->name('telemarketing.store');
Route::get('show-telemarketing', [TelemarketingController::class, 'show'])->name('telemarketing.show');
Route::get('edit-telemarketing', [TelemarketingController::class, 'edit'])->name('telemarketing.edit');
Route::get('update-telemarketing', [TelemarketingController::class, 'update'])->name('telemarketing.update');
Route::get('destroy-telemarketing', [TelemarketingController::class, 'destroy'])->name('telemarketing.destroy');


// Cursos
Route::get('index-curso', [CursoController::class, 'index'])->name('curso.index');
Route::get('create-curso', [CursoController::class, 'create'])->name('curso.create');
Route::get('store-curso', [CursoController::class, 'store'])->name('curso.store');
Route::get('show-curso', [CursoController::class, 'show'])->name('curso.show');
Route::get('edit-curso', [CursoController::class, 'edit'])->name('curso.edit');
Route::get('update-curso', [CursoController::class, 'update'])->name('curso.update');
Route::get('destroy-curso', [CursoController::class, 'destroy'])->name('curso.destroy');


