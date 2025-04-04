<?php

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\IndicacaoController;
use App\Http\Controllers\MidiaController;
use App\Http\Controllers\TelemarketingController;
use App\Http\Controllers\UserController;
use App\Models\Telemarketing;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pgPrincipal');
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
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/delete-user/{id}', [UserController::class, 'delete'])->name('user.delete');

// Funcionários
Route::resource('funcionario', FuncionarioController::class);
Route::delete('/delete-funcionario/{id}', [FuncionarioController::class, 'delete'])->name('funcionario.delete');

// Atendimentos
Route::resource('atendimento', AtendimentoController::class);
Route::delete('/delete-atendimento/{id}', [AtendimentoController::class, 'delete'])->name('atendimento.delete');

// Telemarketing
Route::resource('telemarketing', TelemarketingController::class);
Route::delete('/delete-telemarketing/{id}', [TelemarketingController::class, 'delete'])->name('telemarketing.delete');

// Cursos
Route::resource('curso', CursoController::class);
Route::delete('/delete-curso/{id}', [CursoController::class, 'delete'])->name('curso.delete');

//Midia
Route::resource('midia', MidiaController::class);
Route::delete('/delete-midia/{id}', [MidiaController::class, 'delete'])->name('midia.delete');

//Indicação
Route::resource('indicacao', IndicacaoController::class);
Route::delete('/delete-indicacao/{id}', [IndicacaoController::class, 'delete'])->name('indicacao.delete');

