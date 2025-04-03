<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator as ValidationValidator;

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
        $validator = FacadesValidator::make($request->all(), [
            'password' => 'nullable|min:8|confirmed', // 'confirmed' exige que haja um campo 'password_confirmation' igual
        ],[
            'password.confirmed' => 'As senhas não coincidem. Por favor, tente novamente.',
            'password.min' => 'A senha precisa ter pelo menos 8 caracteres.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
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
    public function edit($id){
        $user = User::find($id);

        if(!$user){
            return redirect('user.index')->with('error', 'Usuário não encontrado');
        }
        return view('user.create', compact('user'));
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        // CARREGAR A VIEW
        $user = User::find($id);
        if(!$user){
            return redirect('user.index')->with('error', 'Usuário não encontrado');
        }   

        $validator = FacadesValidator::make($request->all(), [
            'password' => 'nullable|min:8|confirmed', // 'confirmed' exige que haja um campo 'password_confirmation' igual
        ],[
            'password.confirmed' => 'As senhas não coincidem. Por favor, tente novamente.',
            'password.min' => 'A senha precisa ter pelo menos 8 caracteres.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->name;
        
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user.index');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Funcionário deletado com sucesso!');
        }

        return redirect()->route('user.index')->with('error', 'Funcionário não encontrado!');
    }
}
