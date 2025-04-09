<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Indicacao;
use Illuminate\Http\Request;

class IndicacaoController extends Controller
    {
        // LISTAR
        public function index(){
         // CARREGAR A VIEW
         $indicacoes = Atendimento::all(); //carrega a relação com o user "JOIN"
         return view('indicacao.index', compact('indicacoes'));
     }
     
     // DETALHES
     public function create(){
         // CARREGAR A VIEW
         return view('indicacao.create');
     }
     
     // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
     public function store(){
     
     }
     
     // CADASTRAR NO BANCO DE DADOS NOVA CONTA
     public function show(){
         dd('Cadastrar');
     }
     
     // CARREGAR O FORMULÁRIO EDITAR CONTA
     public function edit(){
     }
     // EDITAR NO BANCO DE DADOS A CONTA
     public function update(){
     }
     // EXCLUIR DO BANCO DE DADOS A CONTA
     public function delete(){
     }
}
