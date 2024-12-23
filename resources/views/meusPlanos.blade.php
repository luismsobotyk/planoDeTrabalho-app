{{-- resources/views/planos.blade.php --}}
@extends('layouts.main_layout')

@section('title')
    <title>Listagem de Planos</title>
@endsection

@section('other-css-assets')
    <style>
        .table-container {
            margin-top: 20px;
        }
        .btn-visualizar {
            background-color: #33a047;
            border-color: #33a047;
            color: white;
        }
        .btn-visualizar:hover {
            background-color: #28a037;
            border-color: #28a037;
        }
        .btn-preencher {
            background-color: #c72027;
            border-color: #c72027;
            color: white;
        }
        .btn-preencher:hover {
            background-color: #a51520;
            border-color: #a51520;
        }
    </style>
@endsection

@section('content')

    <!-- Tabela de Listagem de Planos -->
    <div class="container table-container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h2>Listagem de Planos</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Período</th>
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
                            {{ $plano->periodo->semestre }}
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
                            @if($plano->situacao == 'Pendente')
                                <a href="{{ route('preencher', ['plano_id' => $plano->id]) }}" class="btn btn-preencher">Preencher</a>
                            @elseif($plano->situacao == 'Em Revisão')
                                <a href="{{ route('plano.view', ['plano_id' => $plano->id]) }}" class="btn btn-visualizar">Visualizar</a>
                            @elseif($plano->situacao == 'Ajustes Necessários')
                                <a href="{{ route('preencher', ['plano_id' => $plano->id]) }}" class="btn btn-preencher">Revisar</a>
                            @else
                                <a href="#" class="btn btn-visualizar">Visualizar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
