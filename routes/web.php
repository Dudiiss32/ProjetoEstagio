<?php

use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MidiaController;
use App\Http\Controllers\TelemarketingController;
use App\Http\Controllers\UserController;
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
Route::get('/edit-user', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user', [UserController::class, 'update'])->name('user.update');
Route::delete('/destroy-user', [UserController::class, 'destroy'])->name('user.destroy');

// Funcionários
Route::resource('funcionario', FuncionarioController::class);

// Atendimentos
Route::resource('atendimento', AtendimentoController::class);

// Telemarketing
Route::resource('telemarketing', TelemarketingController::class);

// Cursos
Route::resource('curso', CursoController::class);

//Midia
Route::resource('midia', MidiaController::class);

