<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // LISTAR
    public function index(){
        // CARREGAR A VIEW
        $users = User::all();
        Gate::authorize('ver-users');
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
            'user' => $request->user,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'isAdmin' => $request->isAdmin
        ]);
        return redirect()->route('user.index')->with('success', 'Usuário cadastrado com sucesso!');
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
        $user->user = $request->user;
        $user->email = $request->email;
        $user->isAdmin = $request->isAdmin;
        
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'Usuário atualizado com sucesso');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Usuário deletado com sucesso!');
        }

        return redirect()->route('user.index')->with('error', 'Usuário não encontrado!');
    }
}
