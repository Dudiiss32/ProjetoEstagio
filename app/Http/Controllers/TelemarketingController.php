<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Midia;
use App\Models\Telemarketing;
use App\Models\User;
use Illuminate\Http\Request;

class TelemarketingController extends Controller
{
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $telemarketings = Telemarketing::with('user')->get();
        return view('telemarketing.index', compact('telemarketings'));
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        $users = User::all();

        return view('telemarketing.create', compact('users'));
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(Request $request){
        // CARREGAR A VIEW
        $midiaTele = Midia::where('nome', 'Telemarketing')->first();
        if(!$midiaTele){
            return back()->withErrors(['id_midia' => "A mídia telemarketing não foi encontrada"]);
        }
        Telemarketing::create([
            'cliente' => $request->cliente,
            'telefone' => $request->telefone,
            'agendamento' => $request->agendamento,
            'hora' => $request->hora,
            'id_user' => $request->id_user
        ]);
        Lead::create([
            'cliente' => $request->cliente,
            'telefone' => $request->telefone,
            'id_user' => $request->id_user,
            'matricula' => $request->matricula ?? false,
            'observacao' => $request->observacao ?? '',
            'id_curso' => $request->id_curso ?? null,
            'id_midia' => $request->id_midia ?? $midiaTele->id,
        ]);
        return redirect()->route('telemarketing.index');
    }

    // CADASTRAR NO BANCO DE DADOS NOVA CONTA
    public function show(){
        dd('Cadastrar');
    }

    // CARREGAR O FORMULÁRIO EDITAR CONTA
    public function edit($id){
        $telemarketing = Telemarketing::find($id);
        $users = User::all();

        if(!$telemarketing){
            return redirect('telemarketing.index')->with('error', 'Cadastro não encontrado');
        }
        return view('telemarketing.create', compact(['telemarketing', 'users']));
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        // CARREGAR A VIEW
        $telemarketing = Telemarketing::find($id);
        if(!$telemarketing){
            return redirect('telemarketing.index')->with('error', 'Cadastro não encontrado');
        }
        
        $telemarketing->id_user = $request->id_user;
        $telemarketing->cliente = $request->cliente;
        $telemarketing->telefone = $request->telefone;
        $telemarketing->agendamento = $request->agendamento;
        $telemarketing->hora = $request->hora;

        $telemarketing->save();

        return redirect()->route('telemarketing.index');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $telemarketing = Telemarketing::find($id);
        if($telemarketing){
            $telemarketing->delete();
            return redirect()->route('telemarketing.index')->with('success', 'Funcionário deletado com sucesso!');
        }

        return redirect()->route('telemarketing.index')->with('error', 'Funcionário não encontrado!');
    }
}
