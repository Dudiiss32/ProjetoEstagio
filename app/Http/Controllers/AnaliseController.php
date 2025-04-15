<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Telemarketing;

class AnaliseController extends Controller
{
    public function index(){
        // CARREGAR A VIEW
        $leads = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_leads')->groupByRaw('MONTH(data), id_user')->with('user')->get();
        $matriculas = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_matriculas')->where('matricula', true)->groupByRaw('MONTH(data), id_user')->get();
        $telemarketings = Telemarketing::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_telemarketings')->groupByRaw('MONTH(data), id_user')->with('user')->get();


         // Criar um array com todos os dados agrupados
        $dados = [];

        foreach ($leads as $lead) {
            $chave = $lead->id_user . '-' . $lead->mes;
            $dados[$chave] = [
                'id_user' => $lead->id_user,
                'mes' => $lead->mes,
                'nome' => $lead->user->name ?? 'Não informado',
                'total_leads' => $lead->total_leads,
                'total_matriculas' => 0,
                'eficiencia' => 0
            ];
        }
        foreach ($telemarketings as $telemarketing) {
            $chave = $telemarketing->id_user . '-' . $telemarketing->mes;
            $dados[$chave] = [
                'id_user' => $telemarketing->id_user,
                'mes' => $telemarketing->mes,
                'nome' => $telemarketing->user->name ?? 'Não informado',
                'total_telemarketings' => $telemarketing->total_telemarketings,
                'total_matriculas' => 0,
                'eficiencia' => 0
            ];
        }

        foreach ($matriculas as $matricula) {
            $chave = $matricula->id_user . '-' . $matricula->mes;

            if (isset($dados[$chave])) {
                $dados[$chave]['total_matriculas'] = $matricula->total_matriculas;

                if ($dados[$chave]['total_leads'] > 0) {
                    $dados[$chave]['eficiencia'] = round(
                        ($matricula->total_matriculas / $dados[$chave]['total_leads']) * 100,
                        2
                    );
                }
            }
        }

        return view('analise.index', ['dados' => $dados]);
    }
}
