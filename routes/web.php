<?php

use App\Http\Controllers\AnaliseController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\IndicacaoController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MidiaController;
use App\Http\Controllers\TelemarketingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login.form');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

// Usuário

Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
Route::get('/show-user', [UserController::class, 'show'])->name('user.show');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/delete-user/{id}', [UserController::class, 'delete'])->name('user.delete');

// Funcionários
Route::resource('funcionario', FuncionarioController::class)->middleware('auth');
Route::delete('/delete-funcionario/{id}', [FuncionarioController::class, 'delete'])->name('funcionario.delete')->middleware('auth');

// Atendimentos
Route::resource('atendimento', AtendimentoController::class)->middleware('auth');
Route::delete('/delete-atendimento/{id}', [AtendimentoController::class, 'delete'])->name('atendimento.delete')->middleware('auth');

// Leads
Route::resource('lead', LeadController::class)->middleware('auth');
Route::delete('/delete-lead/{id}', [leadController::class, 'delete'])->name('lead.delete')->middleware('auth');

// Telemarketing
Route::resource('telemarketing', TelemarketingController::class)->middleware('auth');
Route::delete('/delete-telemarketing/{id}', [TelemarketingController::class, 'delete'])->name('telemarketing.delete')->middleware('auth');

// Cursos
Route::resource('curso', CursoController::class)->middleware('auth');
Route::delete('/delete-curso/{id}', [CursoController::class, 'delete'])->name('curso.delete')->middleware('auth');

//Midia
Route::resource('midia', MidiaController::class)->middleware('auth');
Route::delete('/delete-midia/{id}', [MidiaController::class, 'delete'])->name('midia.delete')->middleware('auth');

//Indicação
Route::resource('indicacao', IndicacaoController::class)->middleware('auth');
Route::delete('/delete-indicacao/{id}', [IndicacaoController::class, 'delete'])->name('indicacao.delete')->middleware('auth');

// Login
Route::view('/login', 'login.form')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

// Análise
Route::resource('analise', AnaliseController::class)->middleware('auth');