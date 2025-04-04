<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Curso;
use App\Models\Midia;
use App\Models\User;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $atendimentos = Atendimento::with(['funcionario', 'midia', 'curso'])->get();
        return view('atendimento.index', compact('atendimentos'));
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        $users = User::all();
        $midias = Midia::all();
        $cursos = Curso::all();
        return view('atendimento.create', compact('users', 'midias', 'cursos'));
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
        return redirect()->route('atendimento.index');
    }

    // CADASTRAR NO BANCO DE DADOS NOVA CONTA
    public function show(){
        dd('Cadastrar');
    }

    // CARREGAR O FORMULÁRIO EDITAR CONTA
    public function edit($id){
        $atendimento = Atendimento::find($id);
        $users = User::all();
        $midias = Midia::all();
        $cursos = Curso::all();

            if(!$atendimento){
                return redirect('atendimento.index')->with('error', 'Funcionário não encontrado');
            }
            return view('atendimento.create', compact(['atendimento', 'users', 'midias', 'cursos']));;
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        $atendimento = Atendimento::find($id);
            if(!$atendimento){
                return redirect('atendimento.index')->with('error', 'Mídia não encontrada');
            }   

            $atendimento->id_funcionario = $request->id_funcionario;
            $atendimento->cliente = $request->cliente;
            $atendimento->telefone = $request->telefone;
            $atendimento->matricula = $request->matricula;
            $atendimento->observacao = $request->observacao;
            $atendimento->id_midia = $request->id_midia;
            $atendimento->id_curso = $request->id_curso;


            $atendimento->save();

            return redirect()->route('atendimento.index');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $atendimento = Atendimento::find($id);
        if($atendimento){
            $atendimento->delete();
            return redirect()->route('atendimento.index')->with('success', 'Funcionário deletado com sucesso!');
        }

        return redirect()->route('atendimento.index')->with('error', 'Funcionário não encontrado!');
    }
}
