<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Telemarketing;
use Illuminate\Http\Request;

class AnaliseController extends Controller
{
    public function index(){
        // CARREGAR A VIEW
        $atendimentos = Atendimento::with('user');
        $telemarketings = Telemarketing::all();

        return view('analise.index', compact(['atendimentos', 'telemarketings']));
    }
}
