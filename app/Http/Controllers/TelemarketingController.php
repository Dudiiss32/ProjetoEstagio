<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelemarketingController extends Controller
{
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        return view('telemarketing.index');
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        return view('telemarketing.create');
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(){
        // CARREGAR A VIEW
        return view('telemarketing.store');
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
        return view('telemarketing.update');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function destroy(){
        dd('Apagar');
    }
}
