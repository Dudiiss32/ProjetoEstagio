<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Lead;
use App\Models\Telemarketing;
use App\Models\User;
use Illuminate\Http\Request;

class AnaliseController extends Controller
{
    public function index(Request $request)
    {
        $funcionario = $request->input('funcionario');
        $mesSelecionado = $request->input('mesSelecionado');

        $users = User::all();
        $mesesDisponiveis = [
            '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril',
            '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto',
            '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro',
        ];

        // Consulta de Leads
        $leads = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_leads')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            ->with('user')
            ->groupByRaw('MONTH(data), id_user')
            ->get();

        // Consulta de Matrículas (todos os leads marcados como matrícula)
        $matriculas = Lead::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_matriculas')
            ->where('matricula', true)
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            ->groupByRaw('MONTH(data), id_user')
            ->get();

        // Consulta de Telemarketings
        $telemarketings = Telemarketing::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_telemarketings')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            ->with('user')
            ->groupByRaw('MONTH(data), id_user')
            ->get();

        // Consulta de Matrículas originadas de Telemarketing
        $matriculasTele = Lead::selectRaw('MONTH(leads.data) as mes, leads.id_user, COUNT(*) as total_matriculas_tele')
            ->where('leads.matricula', true)
            ->join('midias', 'midias.id', '=', 'leads.id_midia')
            ->where('midias.nome', 'Telemarketing')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('leads.id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('leads.data', $mesSelecionado))
            ->groupByRaw('MONTH(leads.data), leads.id_user')
            ->get();
            
        // Consulta de Visitas
        $visitas = Lead::selectRaw('MONTH(leads.data) as mes, leads.id_user, COUNT(*) as total_visitas')
            ->join('midias', 'midias.id', '=', 'leads.id_midia')
            ->where('midias.nome', 'Telemarketing')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('leads.id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('leads.data', $mesSelecionado))
            ->groupByRaw('MONTH(leads.data), leads.id_user')->get();

        
        // Consulta de Agendados
        $agendados = Telemarketing::selectRaw('MONTH(data) as mes, id_user, COUNT(*) as total_agendados')
            ->whereNotNull('agendamento')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            ->groupByRaw('MONTH(data), id_user')
            ->get();
        
        $metaTeles = Funcionario::selectRaw('MONTH(data) as mes, id_user, metaTele')
            ->whereNotNull('metaTele')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            // ->groupByRaw('MONTH(data), id_user')
            ->get();

        $metaIndicacoes = Funcionario::selectRaw('MONTH(data) as mes, id_user, metaIndicacoes')
            ->whereNotNull('metaIndicacoes')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            // ->groupByRaw('MONTH(data), id_user')
            ->get();
        

        $dados = [];

        // Preenche com os dados de leads
        foreach ($leads as $lead) {
            $chave = "{$lead->id_user}-{$lead->mes}";
            $dados[$chave] = [
                'id_user' => $lead->id_user,
                'mes' => $lead->mes,
                'nome' => $lead->user->name ?? 'Não informado',
                'total_leads' => $lead->total_leads,
                'total_matriculas' => 0,
                'total_telemarketings' => 0,
                'total_matriculas_tele' => 0,
                'total_agendados' => 0,
                'total_visitas' => 0,
                'eficiencia' => 0,
            ];
        }

        // Adiciona dados de telemarketing
        foreach ($telemarketings as $tele) {
            $chave = "{$tele->id_user}-{$tele->mes}";
            $dados[$chave]['total_telemarketings'] = $tele->total_telemarketings ?? 0;
            $dados[$chave]['nome'] = $dados[$chave]['nome'] ?? ($tele->user->name ?? 'Não informado');
        }

        // Adiciona dados de matrículas
        foreach ($matriculas as $mat) {
            $chave = "{$mat->id_user}-{$mat->mes}";
            $dados[$chave]['total_matriculas'] = $mat->total_matriculas ?? 0;

            if (!empty($dados[$chave]['total_leads'])) {
                $dados[$chave]['eficiencia'] = round(($mat->total_matriculas / $dados[$chave]['total_leads']) * 100, 2);
            }
        }

        // Adiciona matrículas via telemarketing
        foreach ($matriculasTele as $matTele) {
            $chave = "{$matTele->id_user}-{$matTele->mes}";
            $dados[$chave]['total_matriculas_tele'] = $matTele->total_matriculas_tele ?? 0;
        }

        // Adiciona dados de agendados
        foreach ($agendados as $agendado) {
            $chave = "{$agendado->id_user}-{$agendado->mes}";
            $dados[$chave]['total_agendados'] = $agendado->total_agendados ?? 0;
            $dados[$chave]['nome'] = $dados[$chave]['nome'] ?? ($agendado->user->name ?? 'Não informado');
        }

        // Adiciona dados de visitas
        foreach ($visitas as $visita) {
            $chave = "{$visita->id_user}-{$visita->mes}";
            $dados[$chave]['total_visitas'] = $visita->total_visitas ?? 0;
            $dados[$chave]['nome'] = $dados[$chave]['nome'] ?? ($visita->user->name ?? 'Não informado');
        }

        foreach ($metaTeles as $metaTele) {
            $chave = "{$metaTele->id_user}-{$metaTele->mes}";
            $dados[$chave]['total_metaTeles'] = $metaTele->total_metaTeles ?? 0;
            $dados[$chave]['nome'] = $dados[$chave]['nome'] ?? ($metaTele->user->name ?? 'Não informado');
        }

        foreach ($metaIndicacoes as $metaIndicacao) {
            $chave = "{$metaIndicacao->id_user}-{$metaIndicacao->mes}";
            $dados[$chave]['total_metaIndicacoes'] = $metaIndicacao->total_metaIndicacaos ?? 0;
            $dados[$chave]['nome'] = $dados[$chave]['nome'] ?? ($metaIndicacao->user->name ?? 'Não informado');
        }


        return view('analise.index', [
            'dados' => $dados,
            'users' => $users,
            'mesesDisponiveis' => $mesesDisponiveis,
            'mesSelecionado' => $mesSelecionado,
            'funcionarioSelecionado' => $funcionario,
        ]);
    }

    public function create()
    {
        return view('analise.create', ['users' => User::all()]);
    }

    public function store(Request $request)
    {
    }
}
