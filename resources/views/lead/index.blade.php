@extends('layouts.app')

@section('title', 'Lista de leads')

@section('dynamic_link_route', route('lead.create'))
@section('dynamic_link_name', 'Cadastrar novo')

@section('content')
    {{-- Botão Voltar (opcional, se não usar botão no layout) --}}
    @section('show-back-button')
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    @endsection

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

    <h1>Lista de leads</h1>
    
    <form id="formFiltro" action="{{ route('lead.index') }}" method="GET" class="d-flex flex-column">
        <div class="container mt-4 d-flex flex-row gap-5 align-items-center justify-content-end flex-wrap gap-2">
            <div>
                <button id="mostrarTds" type="button" class="cadastro">Mostrar todos</button>
            </div>

            <div class="position-relative">
                <div class="d-flex flex-row gap-5">
                    <label for="usuarioInput" class="form-label">Pesquisar usuário:</label>
                    <input type="text" id="usuarioInput" class="form-control" placeholder="Digite um nome..." autocomplete="off">
                </div>
                <div class="list-group mt-1 position-absolute top-100 start-0 w-100" id="sugestoes" style="display: none;"></div>
                <select id="usuarioSelect" name="usuario_id" class="form-select mt-2" style="display: none;"></select>
            </div>

            <div>
                <select name="" id="">
                    @foreach ($midias as $midia)
                        <option value="{{$midia->id}}">{{$midia->nome}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    @php
        $usuariosUnicos = collect($leads)
            ->filter(fn($lead) => $lead->user)
            ->map(fn($lead) => ['id' => $lead->user->id, 'nome' => $lead->user->name])
            ->unique('nome')
            ->values();
    @endphp

    <script>
        const usuarios = [
            @foreach($usuariosUnicos as $user)
                { id: {{ $user['id'] }}, nome: "{{ addslashes($user['nome']) }}" },
            @endforeach
        ];

        const input = document.getElementById('usuarioInput');
        const sugestoes = document.getElementById('sugestoes');
        const select = document.getElementById('usuarioSelect');

        input.addEventListener('input', function () {
            const termo = this.value.toLowerCase();
            sugestoes.innerHTML = '';
            select.innerHTML = '';
            sugestoes.style.display = 'none';
            select.style.display = 'none';

            if (termo.length === 0) return;

            const filtrados = usuarios.filter(user =>
                user.nome.toLowerCase().includes(termo)
            );

            if (filtrados.length) {
                sugestoes.style.display = 'block';
                filtrados.forEach(user => {
                    const item = document.createElement('button');
                    item.className = 'list-group-item list-group-item-action';
                    item.type = 'button';
                    item.textContent = user.nome;
                    item.addEventListener('click', function () {
                        input.value = user.nome;
                        sugestoes.style.display = 'none';

                        const option = document.createElement('option');
                        option.value = user.id;
                        option.textContent = user.nome;
                        select.innerHTML = '';
                        select.appendChild(option);
                        select.style.display = 'none';
                    });
                    sugestoes.appendChild(item);
                });
            }
        });

        document.getElementById('mostrarTds').addEventListener('click', function (e) {
            e.preventDefault();
            input.value = '';
            sugestoes.innerHTML = '';
            sugestoes.style.display = 'none';
            select.innerHTML = '';
            select.style.display = 'none';
            document.getElementById('formFiltro').submit();
        });
    </script>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Data</th>
                <th>Funcionário</th>
                <th>Mídia</th>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Matrícula</th>
                <th>Observação</th>
                <th>N° de Indicações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leads as $lead)
                <tr>
                    <td>{{ $lead->data->format('d/m/Y') }}</td>
                    <td>{{ $lead->user->name ?? 'Usuário não encontrado' }}</td>
                    <td>{{ $lead->midia->nome }}</td>
                    <td>{{ $lead->cliente }}</td>
                    @php
                        $telefone = preg_replace('/\D/', '', $lead->telefone);
                        if (strlen($telefone) === 11) {
                            $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 5).'-'.substr($telefone, 7);
                        } elseif (strlen($telefone) === 10) {
                            $telefone = '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 4).'-'.substr($telefone, 6);
                        }
                    @endphp
                    <td>{{ $telefone }}</td>
                    <td>{{ $lead->curso->nome ?? '' }}</td>
                    <td>{{ $lead->matricula ? 'Sim' : 'Não' }}</td>
                    <td>{{ $lead->observacao }}</td>
                    <td>{{ $lead->indicacoes->count() }}</td>
                    <td>
                        <form action="{{ route('lead.delete', $lead->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                        <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
