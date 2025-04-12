@extends('layouts.app')

@section('title', 'Lista de leads')

@section('link-cadastro')
    <a href="{{route('lead.create')}}" class="cadastro">Novo lead</a>
@endsection
@section('content')
    <h1>Lista de leads</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Funcionário</th>
                <th>Mídia</th>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Valor do curso</th>
                <th>Matrícula</th>
                <th>Observação</th>
                <th>Nome da indicação</th>
                <th>Telefone da indicação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leads as $lead)
                <tr>
                    <td>{{$lead->data->format('d/m/Y')}}</td>
                    <td>{{$lead->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$lead->midia->nome}}</td>
                    <td>{{$lead->cliente}}</td>
                    @php
                        $telefone = preg_replace('/\D/', '', $lead->telefone);

                        if (strlen($telefone) === 11) {
                            // (51) 91234-5678
                            $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 5).'-'.substr($telefone, 7);
                        } elseif (strlen($telefone) === 10) {
                            // (51) 1234-5678
                            $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 4).'-'.substr($telefone, 6);
                        }
                    @endphp
                    <td>{{$telefone}}</td>
                    <td>{{$lead->curso->nome}}</td>
                    <td>{{$lead->curso->valor}}</td>
                    <td>{{$lead->matricula ? 'Sim' : 'Não'}}</td>
                    <td>{{$lead->observacao}}</td>
                    <td>
                        @if ($lead->indicacoes->count())
                        <ul>
                            @foreach ($lead->indicacoes as $indicacao)
                                <li>{{$indicacao->nome}}</li>
                            @endforeach
                        </ul>
                        @else
                        <p>Não há indicações</p>
                        @endif
                    </td>
                    <td>
                        @if ($lead->indicacoes->count())
                        <ul>
                            @foreach ($lead->indicacoes as $indicacao)
                                <li>{{$indicacao->telefone}}</li>
                            @endforeach
                        </ul>
                        @else
                        <p>Não há indicações</p>
                        @endif
                    </td>
                    <td>{{$lead->indicacao_telefone}}</td>
                    <td>
                        <form action="{{route('lead.delete', $lead->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
