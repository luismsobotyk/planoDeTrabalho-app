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
                        <td>{{ $plano->periodo->semestre }}</td>
                        <td>{{ $plano->situacao }}</td>
                        <td>
                            @if($plano->situacao == 'Pendente')
                                <a href="{{ route('preencher', ['plano_id' => $plano->id]) }}" class="btn btn-preencher">Preencher</a>
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
