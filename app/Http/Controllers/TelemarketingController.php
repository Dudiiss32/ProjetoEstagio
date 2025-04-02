<?php

namespace App\Http\Controllers;

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
        Telemarketing::create([
            'cliente' => $request->cliente,
            'telefone' => $request->telefone,
            'agendamento' => $request->agendamento,
            'hora' => $request->hora,
            'teles' => $request->teles,
            'id_user' => $request->id_user
        ]);
        return redirect()->route('telemarketing.index');
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
        return view('telemarketing.update');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function destroy(){
        dd('Apagar');
    }
}
