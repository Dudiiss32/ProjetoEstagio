<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Indicacao;
use App\Models\Lead;
use App\Models\Midia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
     // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $leads = Lead::with(['user', 'midia', 'curso', 'indicacoes'])->get();
        return view('lead.index', compact(['leads']));
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        $users = User::all();
        $midias = Midia::all();
        $cursos = Curso::all();
        return view('lead.create', compact('users', 'midias', 'cursos'));
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(Request $request){
        // CARREGAR A VIEW
        $telefone = preg_replace('/\D/', '', $request->input('telefone'));

        $lead = Lead::create([
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
                $lead->indicacoes()->create([
                    'nome' => $indicacao['nome'],
                    'telefone' => $indicacao['telefone'],
                ]);
            }
        }

        return redirect()->route('lead.index');
    }

    // CADASTRAR NO BANCO DE DADOS NOVA CONTA
    public function show(){
        dd('Cadastrar');
    }

    // CARREGAR O FORMULÁRIO EDITAR CONTA
    public function edit($id){
        $lead = Lead::find($id);
        $users = User::all();
        $midias = Midia::all();
        $cursos = Curso::all();
        $indicacoes = Indicacao::all();

            if(!$lead){
                return redirect('lead.index')->with('error', 'Funcionário não encontrado');
            }
            return view('lead.create', compact(['lead', 'users', 'midias', 'cursos', 'indicacoes']));;
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        $lead = Lead::findOrFail($id);

        $lead->update([
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
                    $lead->indicacoes()->create([
                        'nome' => $indicacao['nome'],
                        'telefone' => $indicacao['telefone'],
                    ]);
                }
            }
        }

        return redirect()->route('lead.index')->with('success', 'Lead atualizado com sucesso!');
    }

    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $lead = Lead::find($id);
        if($lead){
            $lead->delete();
            return redirect()->route('lead.index')->with('success', 'Lead deletado com sucesso!');
        }

        return redirect()->route('lead.index')->with('error', 'Lead não encontrado!');
    }
}
