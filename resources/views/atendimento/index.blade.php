@extends('layouts.app')

@section('title', 'Lista de atendimentos')

@section('link-cadastro')
    <a href="{{route('atendimento.create')}}" class="cadastro">Novo atendimento</a>
@endsection
@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Lista de atendimentos</h1>
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
            @foreach ($atendimentos as $atendimento)
                <tr>
                    <td>{{$atendimento->data->format('d/m/Y')}}</td>
                    <td>{{$atendimento->user->name ?? 'Usuário não encontrado'}}</td>
                    <td>{{$atendimento->midia->nome}}</td>
                    <td>{{$atendimento->cliente}}</td>
                    @php
                        $telefone = preg_replace('/\D/', '', $atendimento->telefone);

                        if (strlen($telefone) === 11) {
                            // (51) 91234-5678
                            $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 5).'-'.substr($telefone, 7);
                        } elseif (strlen($telefone) === 10) {
                            // (51) 1234-5678
                            $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 4).'-'.substr($telefone, 6);
                        }
                    @endphp
                    <td>{{$telefone}}</td>
                    <td>{{$atendimento->curso->nome}}</td>
                    <td>{{$atendimento->curso->valor}}</td>
                    <td>{{$atendimento->matricula ? 'Sim' : 'Não'}}</td>
                    <td>{{$atendimento->observacao}}</td>
                    <td>
                        @if ($atendimento->indicacoes->count())
                        <ul>
                            @foreach ($atendimento->indicacoes as $indicacao)
                                <li>{{$indicacao->nome}}</li>
                            @endforeach
                        </ul>
                        @else
                        <p>Não há indicações</p>
                        @endif
                    </td>
                    <td>
                        @if ($atendimento->indicacoes->count())
                        <ul>
                            @foreach ($atendimento->indicacoes as $indicacao)
                                <li>{{$indicacao->telefone}}</li>
                            @endforeach
                        </ul>
                        @else
                        <p>Não há indicações</p>
                        @endif
                    </td>
                    <td>{{$atendimento->indicacao_telefone}}</td>
                    <td>
                        <form action="{{route('atendimento.delete', $atendimento->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button> 
                        </form>
                        <a href="{{ route('atendimento.edit', $atendimento->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection
