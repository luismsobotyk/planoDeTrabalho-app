@extends('layouts.main_layout')

@section('title')
    <title>Cadastro e Listagem de Períodos</title>
@endsection

@section('other-css-assets')
    <style>
        .table-container, .form-container {
            margin-top: 20px;
        }
        .btn-submit {
            background-color: #33a047;
            border-color: #33a047;
            color: white;
        }
        .btn-submit:hover {
            background-color: #28a037;
            border-color: #28a037;
        }
        .form-control:focus {
            border-color: #33a047;
            box-shadow: 0 0 0 0.2rem rgba(51, 160, 71, 0.25);
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
@endsection

@section('content')
    <!-- Tabela de Listagem de Períodos -->
    <div class="container table-container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h2>Listagem de Períodos</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Semestre</th>
                <th>Data de Abertura</th>
                <th>Data de Fechamento</th>
                <th>Usuário que Cadastrou</th>
            </tr>
            </thead>
            <tbody>
            @if($periodos->isEmpty())
                <tr>
                    <td colspan="4" class="text-center text-muted fst-italic">Nenhum período cadastrado</td>
                </tr>
            @else
                @foreach($periodos as $periodo)
                    <tr>
                        <td>{{ $periodo->semestre }}</td>
                        <td>{{ $periodo->abertura }}</td>
                        <td>{{ $periodo->fechamento }}</td>
                        <td>{{ $periodo->usuario->nome }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    <!-- Formulário para Adicionar Novo Período -->
    <div class="container form-container">
        <h2>Cadastrar Novo Período</h2>
        <form action="{{ route('periodos.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="data_abertura" class="form-label">Data de Abertura</label>
                <input type="date" class="form-control" id="data_abertura" name="data_abertura" value="{{ old('data_abertura') }}" required>
                @error('data_abertura')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="data_fechamento" class="form-label">Data de Fechamento</label>
                <input type="date" class="form-control" id="data_fechamento" name="data_fechamento" value="{{ old('data_fechamento') }}" required>
                @error('data_fechamento')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="semestre" class="form-label">Semestre</label>
                <input type="text" class="form-control" id="semestre" name="semestre" placeholder="Ex: 2024/1" value="{{ old('semestre') }}" required>
                @error('semestre')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-submit">Salvar Período</button>
        </form>
    </div>

@endsection
