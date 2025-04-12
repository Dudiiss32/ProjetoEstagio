<?php

namespace App\Http\Controllers;

use App\Models\Lead;

class AnaliseController extends Controller
{
    public function index(){
        // CARREGAR A VIEW
        $leads = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_leads')->groupByRaw('MONTH(data), id_user')->with('user')->get();
        $matriculas = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_matriculas')->where('matricula', true)->groupByRaw('MONTH(data), id_user')->get();

        foreach($leads as $lead){
            foreach($matriculas as $matricula){
                if ($matricula->mes == $lead->mes && $matricula->id_user == $lead->id_user) {
                    $eficiencia = ($matricula->total_matriculas /$lead->total_leads ) * 100;
                }
            }
        }

        return view('analise.index', compact(['leads', 'matriculas', 'eficiencia']));
    }
}
