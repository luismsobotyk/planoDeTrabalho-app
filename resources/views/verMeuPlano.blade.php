@extends('layouts.main_layout')

@section('title')
    <title>Plano {{ $plano->periodo->semestre }}</title>
@endsection

@section('other-css-assets')

@endsection

@section('content')
    <div class="container mt-5">
        <h2>Plano de Trabalho {{ $plano->periodo->semestre }}</h2>
        <span class="badge
            @if($plano->situacao == 'Publicado') bg-success
            @elseif($plano->situacao == 'Em Revisão') bg-warning text-dark
            @elseif($plano->situacao == 'Ajustes Necessários') bg-danger
            @elseif($plano->situacao == 'Pendente') bg-orange text-dark
            @else bg-secondary @endif">
            {{ $plano->situacao }}
        </span>

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
                    <td colspan="3" class="text-muted fst-italic text-center">Nenhuma Atividade Administrativa cadastrada</td>
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
                    <td colspan="2" class="text-muted fst-italic text-center">Nenhuma Atividade de Extensão cadastrada</td>
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
                    <td colspan="2" class="text-muted fst-italic text-center">Nenhuma Atividade de Pesquisa cadastrada</td>
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
                    <td colspan="2" class="text-muted fst-italic text-center">Nenhuma Atividade de Ensino cadastrada</td>
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

@endsection
