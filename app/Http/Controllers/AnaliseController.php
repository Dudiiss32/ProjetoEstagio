<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Indicacao;
use App\Models\Lead;
use App\Models\Telemarketing;
use App\Models\User;
use Illuminate\Http\Request;

class AnaliseController extends Controller
{
    public function carregarDados($funcionario, $mesSelecionado = null, $mesInicio = null, $mesFim = null)
    {

        $users = User::all();

        $funcionarioSelecionado = $funcionario ?? $users->first()->id;

        $funcionario = $funcionarioSelecionado;

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

        $indicacoes = Indicacao::selectRaw('MONTH(indicacaos.data) as mes, leads.id_user, COUNT(*) as total_indicacoes')
            ->join('leads', 'leads.id', '=', 'indicacaos.lead_id')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('leads.id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('indicacaos.data', $mesSelecionado))
            ->groupByRaw('MONTH(indicacaos.data), leads.id_user')->get();
        
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

        $tempoTele = Funcionario::selectRaw('MONTH(data) as mes, id_user, tempoTele')
            ->whereNotNull('tempoTele')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            // ->groupByRaw('MONTH(data), id_user')
            ->get();

        $tempoLead = Funcionario::selectRaw('MONTH(data) as mes, id_user, tempoLead')
            ->whereNotNull('tempoLead')
            ->when($funcionario && $funcionario != -1, fn($q) => $q->where('id_user', $funcionario))
            ->when($mesSelecionado, fn($q) => $q->whereMonth('data', $mesSelecionado))
            // ->groupByRaw('MONTH(data), id_user')
            ->get();

        // ...

        $dados = [];

        function inicializarChave(&$dados, $id_user, $mes, $nome = 'Não informado') {
            $chave = "{$id_user}-{$mes}";

            if (!isset($dados[$chave])) {
                $dados[$chave] = [
                    'id_user' => $id_user,
                    'mes' => $mes,
                    'nome' => $nome,
                    'total_leads' => 0,
                    'total_matriculas' => 0,
                    'total_telemarketings' => 0,
                    'total_matriculas_tele' => 0,
                    'total_agendados' => 0,
                    'total_visitas' => 0,
                    'metaTele' => 0,
                    'metaIndicacoes' => 0,
                    'total_indicacoes' => 0,
                    'eficiencia' => 0,
                    'tempoTele' => 0,
                    'tempoLead' => 0,
                ];
            }

            return $chave;
        }

        // Leads
        foreach ($leads as $lead) {
            $chave = inicializarChave($dados, $lead->id_user, $lead->mes, $lead->user->name ?? 'Não informado');
            $dados[$chave]['total_leads'] = $lead->total_leads ?? 0;
        }

        // Telemarketing
        foreach ($telemarketings as $tele) {
            $chave = inicializarChave($dados, $tele->id_user, $tele->mes, $tele->user->name ?? 'Não informado');
            $dados[$chave]['total_telemarketings'] = $tele->total_telemarketings ?? 0;
        }

        // Matrículas
        foreach ($matriculas as $mat) {
            $chave = inicializarChave($dados, $mat->id_user, $mat->mes);
            $dados[$chave]['total_matriculas'] = $mat->total_matriculas ?? 0;

            if (!empty($dados[$chave]['total_leads'])) {
                $dados[$chave]['eficiencia'] = round(($mat->total_matriculas / $dados[$chave]['total_leads']) * 100, 2);
            }
        }

        // Matrículas via Telemarketing
        foreach ($matriculasTele as $matTele) {
            $chave = inicializarChave($dados, $matTele->id_user, $matTele->mes);
            $dados[$chave]['total_matriculas_tele'] = $matTele->total_matriculas_tele ?? 0;
        }

        // Agendados
        foreach ($agendados as $agendado) {
            $chave = inicializarChave($dados, $agendado->id_user, $agendado->mes);
            $dados[$chave]['total_agendados'] = $agendado->total_agendados ?? 0;
        }

        // Visitas
        foreach ($visitas as $visita) {
            $chave = inicializarChave($dados, $visita->id_user, $visita->mes);
            $dados[$chave]['total_visitas'] = $visita->total_visitas ?? 0;
        }

        // Meta Telemarketing
        foreach ($metaTeles as $metaTele) {
            $chave = inicializarChave($dados, $metaTele->id_user, $metaTele->mes);
            $dados[$chave]['metaTele'] = $metaTele->metaTele ?? 0;
        }

        // Meta Indicações
        foreach ($metaIndicacoes as $metaIndicacao) {
            $chave = inicializarChave($dados, $metaIndicacao->id_user, $metaIndicacao->mes);
            $dados[$chave]['metaIndicacoes'] = $metaIndicacao->metaIndicacoes ?? 0;
        }

        foreach ($indicacoes as $indicacao) {
            $chave = inicializarChave($dados, $indicacao->id_user, $indicacao->mes);
            $dados[$chave]['total_indicacoes'] = $indicacao->total_indicacoes ?? 0;
        }

        foreach ($tempoTele as $tpTele) {
            $chave = inicializarChave($dados, $tpTele->id_user, $tpTele->mes);
            $dados[$chave]['tempoTele'] = $tpTele->tempoTele ?? 0;
        }

        foreach ($tempoLead as $tpLead) {
            $chave = inicializarChave($dados, $tpLead->id_user, $tpLead->mes);
            $dados[$chave]['tempoLead'] = $tpLead->tempoLead ?? 0;
        }



        return [
            'dados' => $dados,
            'users' => $users,
            'mesesDisponiveis' => $mesesDisponiveis,
            'mesSelecionado' => $mesSelecionado,
        ];
    }
    public function index(Request $request)
    {
        $funcionario = $request->input('funcionario');
        $mesSelecionado = $request->input('mesSelecionado');

        $dados = $this->carregarDados($funcionario, $mesSelecionado);

        return view('analise.index', $dados);
    }

    public function create()
    {
        return view('analise.create', ['users' => User::all()]);
    }

    public function grafico(Request $request)
    {

        $funcionario = $request->input('funcionario');
        $mesSelecionado = $request->input('mesSelecionado');
        $mesInicio = $request->input('mesInicio');
        $mesFim = $request->input('mesFim');

        $resultado = $this->carregarDados($funcionario, $mesSelecionado);
        $dados = $resultado['dados'];


        $mesesNomes = [
            '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril',
            '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto',
            '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro',
        ];

        foreach ($dados as $dado) {
            $numeroMes = str_pad($dado['mes'], 2, '0', STR_PAD_LEFT); 
            $mes[] = $mesesNomes[$numeroMes] ?? $numeroMes;
            $total_leads = $dado['total_leads'];
            $total_matriculas = $dado['total_matriculas'];
            $total_telemarketings = $dado['total_telemarketings'];
            $total_matriculas_tele = $dado['total_matriculas_tele'];
            $total_agendados = $dado['total_agendados'];
            $total_visitas = $dado['total_visitas'];
            $metaTele = $dado['metaTele'];
            $metaIndicacoes = $dado['metaIndicacoes'];
            $tempoTele = $dado['tempoTele'];
            $tempoLead = $dado['tempoLead'];
        }
        // Labels
        $leadsLabel = "'Comparativo de total de leads por mês'";

        $matriculasLabel = "'Comparativo de total de matrículas por mês'";

        $totalMesesDisponiveis = $mes;
        
        $total_matriculas_agendados_visitas = [
            $total_matriculas,
            $total_agendados,
            $total_visitas
        ];


        return view('analise.grafico', [
            'meses' => json_encode($totalMesesDisponiveis),
            'leadsLabel' => json_encode($leadsLabel),
            'matriculasLabel' => json_encode($matriculasLabel),
        
            'total_leads' => json_encode($total_leads),
            'total_matriculas' => json_encode($total_matriculas),
            'total_telemarketings' => json_encode($total_telemarketings),
            'total_matriculas_tele' => json_encode($total_matriculas_tele),
            'total_agendados' => json_encode($total_agendados),
            'total_visitas' => json_encode($total_visitas),
            'total_mav' => json_encode($total_matriculas_agendados_visitas),
            'meta_tele'
        ]);
    }

    
}
