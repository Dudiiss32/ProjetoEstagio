<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Curso;
use App\Models\Indicacao;
use App\Models\Midia;
use App\Models\User;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $atendimentos = Atendimento::with(['user', 'midia', 'curso', 'indicacoes'])->get();
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
        $telefone = preg_replace('/\D/', '', $request->input('telefone'));

        $atendimento = Atendimento::create([
            'id_user' => $request->id_user,
            'cliente' => $request->cliente,
            'telefone' => $telefone,
            'matricula' => $request->matricula,
            'observacao' => $request->observacao,
            'id_midia' => $request->id_midia,
            'id_curso' => $request->id_curso,
        ]);

        $indicacoes = $request->input('indicacoes', []);
        foreach ($indicacoes as $indicacao) {
            if (!empty($indicacao['nome'])) {
                $atendimento->indicacoes()->create([
                    'nome' => $indicacao['nome'],
                    'telefone' => $indicacao['telefone'],
                ]);
            }
        }

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
        $indicacoes = Indicacao::all();

            if(!$atendimento){
                return redirect('atendimento.index')->with('error', 'Funcionário não encontrado');
            }
            return view('atendimento.create', compact(['atendimento', 'users', 'midias', 'cursos', 'indicacoes']));;
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        $atendimento = Atendimento::findOrFail($id);

        $atendimento->update([
            'id_user' => $request->id_user,
            'cliente' => $request->cliente,
            'telefone' => $request->telefone,
            'matricula' => $request->matricula,
            'observacao' => $request->observacao,
            'id_midia' => $request->id_midia,
            'id_curso' => $request->id_curso,
        ]);

        if ($request->has('indicacoes')) {
            foreach ($request->indicacoes as $indicacao) {
                // Se tem ID, atualiza
                if (!empty($indicacao['id'])) {
                    \App\Models\Indicacao::where('id', $indicacao['id'])->update([
                        'nome' => $indicacao['nome'],
                        'telefone' => $indicacao['telefone'],
                    ]);
                } 
                // Se não tem ID, cria nova
                else if (!empty($indicacao['nome']) || !empty($indicacao['telefone'])) {
                    $atendimento->indicacoes()->create([
                        'nome' => $indicacao['nome'],
                        'telefone' => $indicacao['telefone'],
                    ]);
                }
            }
        }

        return redirect()->route('atendimento.index')->with('success', 'Atendimento atualizado com sucesso!');
    }

    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $atendimento = Atendimento::find($id);
        if($atendimento){
            $atendimento->delete();
            return redirect()->route('atendimento.index')->with('success', 'Atendimento deletado com sucesso!');
        }

        return redirect()->route('atendimento.index')->with('error', 'Atendimento não encontrado!');
    }
}
