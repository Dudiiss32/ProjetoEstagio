<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Indicacao;
use App\Models\Lead;
use App\Models\Midia;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
     // LISTAR
    public function index(Request $request){
        // CARREGAR A VIEW
       
    if (!$request->mostrarTds) {

        if ($request->midiaInput) {
            $query = Lead::deMidias($request->midiaInput);
        }

        if ($request->usuarioInput) {
            $query = Lead::deUsuarios($request->usuarioInput);
        }
    }else{
        $query = Lead::with('user');
    }

    $leads = $query->get();

    $midias = Midia::all();

    return view('lead.index', compact(['leads', 'midias']));
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
        $telefone = preg_replace('/\D/', '', $request->input('telefone'));
        
        $request->validate([
            "telefone"=> "min:10",
        ], [
            'telefone.min' => 'O campo telefone deve ter no mínimo 10 números'
        ]);

        $lead = Lead::create([
            'id_user' => $request->id_user,
            'cliente' => $request->cliente,
            'telefone' => $telefone,
            'matricula' => $request->matricula,
            'observacao' => $request->observacao,
            'id_midia' => $request->id_midia,
            'id_curso' => $request->id_curso,
        ]);
    
        foreach ($request->input('indicacoes', []) as $indicacao) {
            if (!empty($indicacao['nome'])) {
                $lead->indicacoes()->create([
                    'nome' => $indicacao['nome'],
                    'telefone' => $indicacao['telefone'],
                ]);
            }
        }
    
        return redirect()->route('lead.index')->with('success', 'Lead adicionado com sucesso');
    }

    // CADASTRAR NO BANCO DE DADOS NOVA CONTA
    public function show(){
        dd('Cadastrar');
    }

    // CARREGAR O FORMULÁRIO EDITAR CONTA
    public function edit($id){
        $lead = Lead::findOrFail($id);

        $users = User::all();
        $midias = Midia::all();
        $cursos = Curso::all();
        $indicacoes = $lead->indicacoes;

            
        return view('lead.create', compact(['lead', 'users', 'midias', 'cursos', 'indicacoes']));;
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        $lead = Lead::findOrFail($id);
        $telefone = preg_replace('/\D/', '', $request->input('telefone'));
    
        $request->validate([
            "telefone"=> "min:10",
        ], [
            'telefone.min' => 'O campo telefone deve ter no mínimo 10 números'
        ]);

        $lead->update([
            'id_user' => $request->id_user,
            'cliente' => $request->cliente,
            'telefone' => $telefone,
            'matricula' => $request->matricula,
            'observacao' => $request->observacao,
            'id_midia' => $request->id_midia,
            'id_curso' => $request->id_curso,
        ]);
    
        foreach ($request->indicacoes as $indicacao) {
            if (!empty($indicacao['id'])) {
                Indicacao::where('id', $indicacao['id'])->update([
                    'nome' => $indicacao['nome'],
                    'telefone' => $indicacao['telefone'],
                ]);
            } else if (!empty($indicacao['nome']) || !empty($indicacao['telefone'])) {
                $lead->indicacoes()->create([
                    'nome' => $indicacao['nome'],
                    'telefone' => $indicacao['telefone'],
                ]);
            }
        }

    
        return redirect()->route('lead.index')->with('success', 'Lead atualizado com sucesso!');
    }

    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $lead = Lead::find($id);
        if ($lead) {
            $lead->delete();
            return redirect()->route('lead.index')->with('success', 'Lead deletado com sucesso!');
        }

        return redirect()->route('lead.index')->with('error', 'Lead não encontrado!');
    }

}
