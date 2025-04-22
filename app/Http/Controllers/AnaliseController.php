<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Telemarketing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnaliseController extends Controller
{
    public function index(Request $request)
    {
        $funcionario = $request->input('funcionario');
        $mesSelecionado = $request->input('mesSelecionado');

        $nomesFuncionarios = User::distinct()->pluck('name');
        $users = User::all();

        $dados = [];

        $mesesDisponiveis = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        ];

        // Queries base
        $leadsQ = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_leads')
            ->groupByRaw('MONTH(data), id_user')
            ->with('user');

        $matriculasQ = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_matriculas')
            ->where('matricula', true)
            ->groupByRaw('MONTH(data), id_user');

        $telemarketingsQ = Telemarketing::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_telemarketings')
            ->groupByRaw('MONTH(data), id_user')
            ->with('user');

        // Filtro por funcionário
        if ($funcionario && $funcionario != '-1') {
            $leadsQ->where('id_user', $funcionario);
            $matriculasQ->where('id_user', $funcionario);
            $telemarketingsQ->where('id_user', $funcionario);
        }

        // Filtro por mês
        if ($mesSelecionado && isset($mesesDisponiveis[$mesSelecionado])) {
            $leadsQ->whereMonth('data', $mesSelecionado);
            $matriculasQ->whereMonth('data', $mesSelecionado);
            $telemarketingsQ->whereMonth('data', $mesSelecionado);
        }

        $leads = $leadsQ->get();
        $matriculas = $matriculasQ->get();
        $telemarketings = $telemarketingsQ->get();

        // Leads
        foreach ($leads as $lead) {
            $chave = $lead->id_user . '-' . $lead->mes;
            $dados[$chave] = [
                'id_user' => $lead->id_user,
                'mes' => $lead->mes,
                'nome' => $lead->user->name ?? 'Não informado',
                'total_leads' => $lead->total_leads,
                'total_matriculas' => 0,
                'total_telemarketings' => 0,
                'eficiencia' => 0
            ];
        }

        // Telemarketing
        foreach ($telemarketings as $tele) {
            $chave = $tele->id_user . '-' . $tele->mes;

            if (!isset($dados[$chave])) {
                $dados[$chave] = [
                    'id_user' => $tele->id_user,
                    'mes' => $tele->mes,
                    'nome' => $tele->user->name ?? 'Não informado',
                    'total_leads' => 0,
                    'total_matriculas' => 0,
                    'total_telemarketings' => 0,
                    'eficiencia' => 0
                ];
            }

            $dados[$chave]['total_telemarketings'] = $tele->total_telemarketings;
        }

        // Matrículas + eficiência
        foreach ($matriculas as $matricula) {
            $chave = $matricula->id_user . '-' . $matricula->mes;

            if (!isset($dados[$chave])) {
                $dados[$chave] = [
                    'id_user' => $matricula->id_user,
                    'mes' => $matricula->mes,
                    'nome' => 'Não informado',
                    'total_leads' => 0,
                    'total_matriculas' => 0,
                    'total_telemarketings' => 0,
                    'eficiencia' => 0
                ];
            }

            $dados[$chave]['total_matriculas'] = $matricula->total_matriculas;

            if ($dados[$chave]['total_leads'] > 0) {
                $dados[$chave]['eficiencia'] = round(
                    ($matricula->total_matriculas / $dados[$chave]['total_leads']) * 100,
                    2
                );
            }
        }

        return view('analise.index', [
            'dados' => $dados,
            'users' => $users,
            'nomesFuncionarios' => $nomesFuncionarios,
            'mesesDisponiveis' => $mesesDisponiveis,
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('analise.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        // Lógica para armazenamento futuro
    }
}
