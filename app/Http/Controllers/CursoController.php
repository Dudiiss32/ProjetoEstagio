<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    // LISTAR
    public function index(){
        $cursos = Curso::all();
        return view('curso.index', compact('cursos'));
    }

    // DETALHES
    public function create(){
        // CARREGAR A VIEW
        return view('curso.create');
    }

    // CARREGAR O FORMULÁRIO CADASTRAR NOVA CONTA
    public function store(Request $request){
        // CARREGAR A VIEW
        Curso::create([
            'nome' => $request->nome,
            'horas' => $request->horas,
            'valor' => $request->valor,
        ]);
        return redirect()->route('curso.index');
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
        return view('curso.update');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function destroy(){
        dd('Apagar');
    }
}
