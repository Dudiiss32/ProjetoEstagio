<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
    {
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $mesAtual = Carbon::now()->month;
        $funcionarios = Funcionario::whereMonth('data', $mesAtual)->with('user')->get();

        return view('funcionario.index', compact('funcionarios'));
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        $users = User::all();

        return view('funcionario.create', compact('users'));
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(Request $request){

        $request->validate([
            'id_user' => 'required|exists:users,id', // Garante que o usuário exista
            'metaTele' => 'required|string',
            'metaMatricula' => 'required|string',
            'metaIndicacoes' => 'required|string',
        ]);
        Funcionario::create([
            'data' => Carbon::now(),
            'id_user' => $request->id_user,
            'metaTele' => $request->metaTele,
            'metaMatricula' => $request->metaMatricula,
            'metaIndicacoes' => $request->metaIndicacoes,
            'tempoTele' => $request->tempoTele,
            'tempoLead' => $request->tempoLead,
        ]);
        return redirect()->route('funcionario.index')->with('success', 'Meta cadastrada com sucesso!');

    }

    // CADASTRAR NO BANCO DE DADOS NOVA CONTA
    public function show(){
        dd('Cadastrar');
    }

    // CARREGAR O FORMULÁRIO EDITAR CONTA
    public function edit($id){
        $funcionario = Funcionario::find($id);
        $users = User::all();

            if(!$funcionario){
                return redirect('funcionario.index')->with('error', 'Meta não encontrada');
            }
            return view('funcionario.create', compact(['funcionario', 'users']));
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        $funcionario = funcionario::find($id);
            if(!$funcionario){
                return redirect('funcionario.index')->with('error', 'Meta não encontrada');
            }   

            $funcionario->id_user = $request->id_user;
            $funcionario->metaTele = $request->metaTele;
            $funcionario->metaMatricula = $request->metaMatricula;
            $funcionario->metaIndicacoes = $request->metaIndicacoes;
            $funcionario->tempoTele = $request->tempoTele;
            $funcionario->tempoLead = $request->tempoLead;


            $funcionario->save();

            return redirect()->route('funcionario.index')->with('success', 'Meta atualizada com sucesso!');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $funcionario = Funcionario::find($id);
            if($funcionario){
                $funcionario->delete();
                return redirect()->route('funcionario.index')->with('success', 'Meta deletada com sucesso!');
            }

            return redirect()->route('funcionario.index')->with('error', 'Meta não encontrada!');
    }
}
