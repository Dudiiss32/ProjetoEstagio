<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $users = User::all();
        return view('user.index', compact('users'));
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        return view('user.create');
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(Request $request){
        // CARREGAR A VIEW
        User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'isAdmin' => false
        ]);
        return redirect()->route('user.index')->with('success', 'Funcionário cadastrado com sucesso!');
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
        return view('user.update');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function destroy(Request $request){
        \User::remove($request->id);
        return redirect()->route('user.index')->with('success', 'Funcionário cadastrado com sucesso!');
    }
}
