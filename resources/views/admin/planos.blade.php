@extends('layouts.main_layout')

@section('title')
    <title>Listagem de Planos</title>
@endsection

@section('other-css-assets')
    <style>
        .table-container {
            margin-top: 20px;
        }
        .btn-revisar {
            background-color: #33a047;
            border-color: #33a047;
            color: white;
        }
        .btn-revisar:hover {
            background-color: #28a037;
            border-color: #28a037;
        }
    </style>
@endsection

@section('content')

    <div class="container table-container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h2>Listagem de Planos</h2>
            <div class="mb-3">
                <label for="semestre" class="form-label">Semestre:</label>
                <select id="semestre" class="form-select" onchange="location = this.value;">
                    @foreach($periodos as $periodo)
                        <option value="{{ route('planos', ['semestre' => str_replace('/', '', $periodo->semestre)]) }}"
                            {{ (isset($semestre) && str_replace('/', '', $periodo->semestre) == str_replace('/', '', $semestre)) ? 'selected' : '' }}>
                            {{ $periodo->semestre }}
                        </option>
                    @endforeach
                </select>
            </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Docente</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @if($planos->isEmpty())
                <tr>
                    <td colspan="3" class="text-center text-muted fst-italic">Nenhum plano encontrado</td>
                </tr>
            @else
                @foreach($planos as $plano)
                    <tr>
                        <td>
                            {{ $plano->usuario->nome }}
                        </td>
                        <td>
                            <span class="badge
                                @if($plano->situacao == 'Publicado') bg-success
                                @elseif($plano->situacao == 'Em Revisão') bg-warning text-dark
                                @elseif($plano->situacao == 'Ajustes Necessários') bg-danger
                                @elseif($plano->situacao == 'Pendente') bg-orange text-dark
                                @else bg-secondary @endif">
                                {{ $plano->situacao }}
                            </span>
                        </td>
                        <td>
                            @if($plano->situacao == 'Em Revisão')
                                <a href="#" class="btn btn-revisar">Revisar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
