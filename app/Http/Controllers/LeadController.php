<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Indicacao;
use App\Models\Lead;
use App\Models\Midia;
use App\Models\Telemarketing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LeadController extends Controller
{
     // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $telemarketings = Lead::whereHas('midia', function($query) {
            $query->where('nome', 'Telemarketing');
        })->with(['user', 'midia', 'curso', 'indicacoes'])->get();
        // ->where(function($query) {
        //     $query->whereNull('id_curso')
        //         ->orWhere('observacao', '')
        //         ->orWhere('matricula', false);
        // })
        


        $leads = Lead::whereDoesntHave('midia', function($query) {
            $query->where('nome', 'Telemarketing'); // Ignora Telemarketing
        })
        ->whereNotNull('id_curso') // Tem curso
        ->where('observacao', '!=', '') // Tem observação
        ->where('matricula', true) // Tem matrícula
        ->with(['user', 'midia', 'curso', 'indicacoes'])
        ->get();
        
        return view('lead.index', compact(['leads', 'telemarketings']));
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
    
        // Verifica se é Telemarketing
        $midia = Midia::find($request->id_midia);
        if ($midia && Str::lower($midia->nome) === 'telemarketing') {
            Telemarketing::create([
                'id_lead' => $lead->id,
                'cliente' => $lead->cliente,
                'telefone' => $lead->telefone,
                'matricula' => $lead->matricula,
            ]);
        }
    
        return redirect()->route('lead.index');
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

        $telemarketing = null;
        if ($lead->midia && $lead->midia->nome === 'Telemarketing') {
            $telemarketing = Telemarketing::where('cliente', $lead->cliente)->where('telefone', $lead->telefone)->first();
        }
            
        return view('lead.create', compact(['lead', 'users', 'midias', 'cursos', 'indicacoes', 'telemarketing']));;
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        $lead = Lead::findOrFail($id);
        $telefone = preg_replace('/\D/', '', $request->input('telefone'));
    
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
    
        // Atualiza ou cria em Telemarketing se a mídia for telemarketing
        $midia = Midia::find($request->id_midia);
        $tele = Telemarketing::where('id_lead', $lead->id)->first();
        if ($tele) {
            $tele->update(
                ['id_lead' => $lead->id],
                [
                    'cliente' => $lead->cliente,
                    'telefone' => $lead->telefone,
                    'id_user' => $lead->id_user
                ]
            );
        } else {
            // Se deixou de ser telemarketing, apaga da tabela
            Telemarketing::where('id_lead', $lead->id)->delete();
        }
    
        return redirect()->route('lead.index')->with('success', 'Lead atualizado com sucesso!');
    }

    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $lead = Lead::find($id);
        $tele = Telemarketing::find($id);
        if($lead){
            $lead->delete();
            return redirect()->route('lead.index')->with('success', 'Lead deletado com sucesso!');
        }
        if($tele){
            $tele->delete();
            return redirect()->route('lead.index')->with('success', 'Lead deletado com sucesso!');
        }

        return redirect()->route('lead.index')->with('error', 'Lead não encontrado!');
    }
}
