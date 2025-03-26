<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
   // LISTAR
   public function index(){
    // CARREGAR A VIEW
    return view('funcionario.index');
}

// DETALHES
public function create(){
    // CARREGAR A VIEW
    return view('funcionario.create');
}

// CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
public function store(Request $request){
    
}

// CADASTRAR NO BANCO DE DADOS NOVA CONTA
public function show(){
    dd('Cadastrar');
}

// CARREGAR O FORMULÁRIO EDITAR CONTA
public function edit(){
    dd('Editar');
}
// EDITAR NO BANCO DE DADOS A CONTA
public function update(){
    // CARREGAR A VIEW
    return view('funcionario.update');
}
// EXCLUIR DO BANCO DE DADOS A CONTA
public function destroy(){
    dd('Apagar');
}
}
