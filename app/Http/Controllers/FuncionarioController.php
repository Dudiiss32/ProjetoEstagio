<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
   // LISTAR
   public function index(){
    // CARREGAR A VIEW
    $funcionarios = Funcionario::with('user')->get(); //carrega a relação com o user "JOIN"
    return view('funcionario.index', compact('funcionarios'));
}

// DETALHES
public function create(){
    // CARREGAR A VIEW
    $users = User::all();

    return view('funcionario.create', compact('users'));
}

// CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
public function store(Request $request){

    $request->validate([
        'id_user' => 'required|exists:users,id', // Garante que o usuário exista
        'metaTele' => 'required|string',
        'metaMatricula' => 'required|string',
        'comissao' => 'required|numeric',
    ]);
    Funcionario::create([
        'id_user' => $request->id_user,
        'metaTele' => $request->metaTele,
        'metaMatricula' => $request->metaMatricula,
        'comissao' => $request->comissao,
    ]);
    return redirect()->route('funcionario.index')->with('success', 'Funcionário cadastrado com sucesso!');

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
    return view('funcionario.update');
}
// EXCLUIR DO BANCO DE DADOS A CONTA
public function destroy(){
    dd('Apagar');
}
}
