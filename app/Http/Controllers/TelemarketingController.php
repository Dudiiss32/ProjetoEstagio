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
        $leads = Lead::all();

        return view('telemarketing.create', compact(['users', 'leads']));
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(Request $request)
    {
        $tele = Telemarketing::create([
            'cliente'     => $request->cliente,
            'telefone'    => $request->telefone,
            'agendamento' => $request->agendamento,
            'hora'        => $request->hora,
            'id_user'     => $request->id_user,
            'id_lead'     => $request->id_lead,
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
    public function update(Request $request, $id)
    {
        $tele = Telemarketing::findOrFail($id);
        $tele->update([
            'cliente'     => $request->cliente,
            'telefone'    => $request->telefone,
            'agendamento' => $request->agendamento,
            'hora'        => $request->hora,
            'id_user'     => $request->id_user,
            'id_lead'     => $request->id_lead,
        ]);

        return redirect()->route('telemarketing.index');
    }

    public function delete($id)
    {
        $tele = Telemarketing::find($id);
        if (!$tele) {
            return redirect()->route('telemarketing.index')
                             ->with('error','Registro não encontrado');
        }
        $tele->delete();

        return redirect()->route('telemarketing.index')->with('success','Telemarketing e Lead deletados');
    }
}
