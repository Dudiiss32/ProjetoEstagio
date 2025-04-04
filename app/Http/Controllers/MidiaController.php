<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use Illuminate\Http\Request;

class MidiaController extends Controller
{
    
    public function index()
    {
        $midias = Midia::all();
        return view('midia.index', compact('midias'));
    }

  
    public function create()
    {
        return view('midia.create');
    }

    public function store(Request $request)
    {
        $existe = Midia::where('nome', $request->nome)->exists();

        if($existe){
            return redirect()->route('midia.index')->with('error', 'Essa mídia já foi adicionada');
        }
        Midia::create([
            'nome' => $request->nome,
        ]);
        return redirect()->route('midia.index')->with('success', 'Mídia adicionada com sucesso');
    }

    public function show(Midia $midia)
    {
        //
    }
    public function edit($id)
    {
        $midia = Midia::find($id);

        if(!$midia){
            return redirect('midia.index')->with('error', 'Usuário não encontrado');
        }
        return view('midia.create', compact('midia'));
    }

    public function update(Request $request, $id)
    {
        $midia = Midia::find($id);
        if(!$midia){
            return redirect('midia.index')->with('error', 'Mídia não encontrada');
        }   

        $midia->nome = $request->nome;
        $midia->save();

        return redirect()->route('midia.index');
    }

    
    public function delete($id)
    {
        $midia = Midia::find($id);
        if($midia){
            $midia->delete();
            return redirect()->route('midia.index')->with('success', 'Mídia deletada com sucesso!');
        }

        return redirect()->route('midia.index')->with('error', 'Mídia não encontrada!');
    }
}
