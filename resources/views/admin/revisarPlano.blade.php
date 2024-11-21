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
            @if(session('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        <h2>Plano de Trabalho {{ $plano->periodo->semestre }} de {{ $plano->usuario->nome }}</h2>
        <span class="badge
            @if($plano->situacao == 'Publicado') bg-success
            @elseif($plano->situacao == 'Em Revisão') bg-warning text-dark
            @elseif($plano->situacao == 'Ajustes Necessários') bg-danger
            @elseif($plano->situacao == 'Pendente') bg-orange text-dark
            @else bg-secondary @endif">
            {{ $plano->situacao }}
        </span>
        <br>
        <form id="planoForm" method="POST" action="{{ route('plano.reprovar', ['plano_id' => $plano->id]) }}">
            @csrf
            <div class="mb-3 mt-3">
                <label for="comentarios" class="form-label">Comentários:</label>
                <textarea class="form-control" name="comentarios" id="comentarios" rows="3"
                @if($plano->situacao!='Em Revisão') disabled @endif>
                    @if(isset($plano->comentario))
                        {{ $plano->comentario->texto }}
                    @endif
                </textarea>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-danger me-2"
                        onclick="submitForm('{{ route('plano.reprovar', ['plano_id' => $plano->id]) }}')"
                        @if($plano->situacao!='Em Revisão') disabled @endif>Solicitar Correção
                </button>
                <button type="button" class="btn btn-success"
                        onclick="submitForm('{{ route('plano.aprovar', ['plano_id' => $plano->id]) }}')"
                        @if($plano->situacao=='Publicado') disabled @endif>Aprovar
                </button>
            </div>
        </form>

        <p class="text-end fst-italic">Última modificação: {{ $plano->updated_at->format('d/m/Y H:i:s')  }}</p>

        <table class="table table-striped text-center">
            <thead>
            <tr>
                <th colspan="2" class="text-center">Informações Pessoais</th>
            </tr>
            <tr>
                <th>Categoria:</th>
                <th>Regime:</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @if($plano->informacoesPessoais->categoria == "" || !$plano->informacoesPessoais->categoria)
                    <td class="text-muted fst-italic">Não informado</td>
                @else
                    <td>{{ $plano->informacoesPessoais->categoria }}</td>
                @endif

                @if($plano->informacoesPessoais->regime == "" || !$plano->informacoesPessoais->regime)
                    <td class="text-muted fst-italic">Não informado</td>
                @else
                    <td>{{ $plano->informacoesPessoais->regime }}</td>
                @endif
            </tr>
            </tbody>
        </table>

        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="3" class="text-center">Aulas</th>
            </tr>
            <tr>
                <th>Disciplina:</th>
                <th>Curso:</th>
                <th>Carga Horária:</th>
            </tr>
            </thead>
            <tbody>
            @if($plano->aulas->isEmpty())
                <tr>
                    <td colspan="3" class="text-muted fst-italic text-center">Nenhuma aula cadastrada</td>
                </tr>
            @else
                @foreach($plano->aulas as $aula)
                    <tr>
                        <td>{{ $aula->disciplina }}</td>
                        <td>{{ $aula->curso }}</td>
                        <td>{{ $aula->carga_horaria }}h00</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="3" class="text-center">Atividades Administrativas</th>
            </tr>
            <tr>
                <th>Descrição:</th>
                <th>Portaria:</th>
                <th>Carga Horária:</th>
            </tr>
            </thead>
            <tbody>
            @if($plano->atividadesAdministrativas->isEmpty())
                <tr>
                    <td colspan="3" class="text-muted fst-italic text-center">Nenhuma Atividade Administrativa
                        cadastrada
                    </td>
                </tr>
            @else
                @foreach($plano->atividadesAdministrativas as $atividade)
                    <tr>
                        <td>{{ $atividade->descricao }}</td>
                        <td>{{ $atividade->portaria }}</td>
                        <td>{{ $atividade->carga_horaria }}h00</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="2" class="text-center">Atividades de Extensão</th>
            </tr>
            <tr>
                <th>Descrição:</th>
                <th>Carga Horária:</th>
            </tr>
            </thead>
            <tbody>
            @if($plano->atividadesExtensao->isEmpty())
                <tr>
                    <td colspan="2" class="text-muted fst-italic text-center">Nenhuma Atividade de Extensão cadastrada
                    </td>
                </tr>
            @else
                @foreach($plano->atividadesExtensao as $atividade)
                    <tr>
                        <td>{{ $atividade->descricao }}</td>
                        <td>{{ $atividade->carga_horaria }}h00</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="2" class="text-center">Atividades de Pesquisa</th>
            </tr>
            <tr>
                <th>Descrição:</th>
                <th>Carga Horária:</th>
            </tr>
            </thead>
            <tbody>
            @if($plano->atividadesPesquisa->isEmpty())
                <tr>
                    <td colspan="2" class="text-muted fst-italic text-center">Nenhuma Atividade de Pesquisa cadastrada
                    </td>
                </tr>
            @else
                @foreach($plano->atividadesPesquisa as $atividade)
                    <tr>
                        <td>{{ $atividade->descricao }}</td>
                        <td>{{ $atividade->carga_horaria }}h00</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="2" class="text-center">Atividades de Ensino</th>
            </tr>
            <tr>
                <th>Descrição:</th>
                <th>Carga Horária:</th>
            </tr>
            </thead>
            <tbody>
            @if($plano->atividadesEnsino->isEmpty())
                <tr>
                    <td colspan="2" class="text-muted fst-italic text-center">Nenhuma Atividade de Ensino cadastrada
                    </td>
                </tr>
            @else
                @foreach($plano->atividadesEnsino as $atividade)
                    <tr>
                        <td>{{ $atividade->descricao }}</td>
                        <td>{{ $atividade->carga_horaria }}h00</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
@section('other-js-assets')
    <script>
        function submitForm(action) {
            const form = document.getElementById('planoForm');
            form.action = action;
            form.submit();
        }
    </script>
@endsection
