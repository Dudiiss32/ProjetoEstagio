<?php

namespace App\Http\Controllers;

use App\Models\Indicacao;
use Illuminate\Http\Request;

class IndicacaoController extends Controller
    {
        // LISTAR
        public function index(){
         // CARREGAR A VIEW
         $indicacoes = Indicacao::all(); //carrega a relação com o user "JOIN"
         return view('indicacao.index', compact('indicacoes'));
     }
     
     // DETALHES
     public function create(){
         // CARREGAR A VIEW
         return view('indicacao.create');
     }
     
     // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
     public function store(Request $request){
     
         Indicacao::create([
             'nome' => $request->nome,
             'telefone' => $request->telefone,
         ]);
         return redirect()->route('indicacao.index')->with('success', 'Funcionário cadastrado com sucesso!');
     
     }
     
     // CADASTRAR NO BANCO DE DADOS NOVA CONTA
     public function show(){
         dd('Cadastrar');
     }
     
     // CARREGAR O FORMULÁRIO EDITAR CONTA
     public function edit($id){
        $indicacao = Indicacao::find($id);

        if(!$indicacao){
            return redirect('indicacao.index')->with('error', 'Indicação não encontrada');
        }
        return view('indicacao.create', compact('indicacao'));
     }
     // EDITAR NO BANCO DE DADOS A CONTA
     public function update(Request $request, $id){
        $indicacao = Indicacao::find($id);
        if(!$indicacao){
            return redirect('indicacao.index')->with('error', 'Mídia não encontrada');
        }   

        $indicacao->nome = $request->nome;
        $indicacao->telefone = $request->telefone;
        $indicacao->save();

        return redirect()->route('indicacao.index');
     }
     // EXCLUIR DO BANCO DE DADOS A CONTA
     public function delete($id){
        $indicacao = Indicacao::find($id);
        if($indicacao){
            $indicacao->delete();
            return redirect()->route('indicacao.index')->with('success', 'Funcionário deletado com sucesso!');
        }

        return redirect()->route('indicacao.index')->with('error', 'Funcionário não encontrado!');
     }
}
