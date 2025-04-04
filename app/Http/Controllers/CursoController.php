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
    public function edit($id){
        $curso = Curso::find($id);

            if(!$curso){
                return redirect('curso.index')->with('error', 'Curso não encontrado');
            }
            return view('curso.create', compact('curso'));
    }
    // EDITAR NO BANCO DE DADOS A CONTA
    public function update(Request $request, $id){
        $curso = Curso::find($id);
            if(!$curso){
                return redirect('curso.index')->with('error', 'Curso não encontrado');
            }   

            $curso->nome = $request->nome;
            $curso->horas = $request->horas;
            $curso->valor = $request->valor;

            $curso->save();

            return redirect()->route('curso.index');
    }
    // EXCLUIR DO BANCO DE DADOS A CONTA
    public function delete($id){
        $curso = Curso::find($id);
        if($curso){
            $curso->delete();
            return redirect()->route('curso.index')->with('success', 'Curso deletado com sucesso!');
        }

        return redirect()->route('curso.index')->with('error', 'Curso não encontrado!');
    }
}
