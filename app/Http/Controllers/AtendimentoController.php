<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Curso;
use App\Models\Funcionario;
use App\Models\Midia;
use App\Models\User;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $atendimentos = Atendimento::with(['funcionario.user', 'midia', 'curso'])->get();
        return view('atendimento.index', compact('atendimentos'));
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        $funcionarios = User::all();
        $midias = Midia::all();
        $cursos = Curso::all();
        return view('atendimento.create', compact('funcionarios', 'midias', 'cursos'));
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(Request $request){
        // CARREGAR A VIEW
        Atendimento::create([
            'id_funcionario' => $request->id_funcionario,
            'cliente' => $request->cliente,
            'telefone' => $request->telefone,
            'matricula' => $request->matricula,
            'observacao' => $request->observacao,
            'id_midia' => $request->id_midia,
            'id_curso' => $request->id_curso,
        ]);
        return view('atendimento.index');
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
        return view('atendimento.update');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function destroy(){
        dd('Apagar');
    }
}
