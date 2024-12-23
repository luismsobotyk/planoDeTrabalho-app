{{-- resources/views/preencher_plano.blade.php --}}
@extends('layouts.main_layout')

@section('title')
    <title>Preenchendo Plano de Trabalho {{ $plano->periodo->semestre }}</title>
@endsection

@section('other-css-assets')
    <style>
        .form-section {
            margin-top: 30px;
        }
        .form-section h4 {
            color: #333;
            font-weight: bold;
        }
        .btn-add {
            background-color: #33a047;
            border-color: #33a047;
            color: white;
        }
        .btn-add:hover {
            background-color: #28a037;
            border-color: #28a037;
        }
        .btn-remove {
            background-color: #c72027;
            border-color: #c72027;
            color: white;
        }
        .btn-remove:hover {
            background-color: #a51520;
            border-color: #a51520;
        }
    </style>
@endsection

@section('content')

    <div class="container mt-5">
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

        <h2>Preenchendo Plano de Trabalho {{ $plano->periodo->semestre }}</h2>
            <span class="badge
            @if($plano->situacao == 'Publicado') bg-success
            @elseif($plano->situacao == 'Em Revisão') bg-warning text-dark
            @elseif($plano->situacao == 'Ajustes Necessários') bg-danger
            @elseif($plano->situacao == 'Pendente') bg-orange text-dark
            @else bg-secondary @endif">
            {{ $plano->situacao }}
        </span>

            @if($plano->situacao=='Ajustes Necessários')
                <div class="mb-3 mt-3">
                    <label for="comentarios" class="form-label">Comentários de {{ $plano->comentario->usuario->nome }}:</label>
                    <textarea class="form-control" name="comentarios" id="comentarios" rows="3" disabled>{{ $plano->comentario->texto }}</textarea>
                </div>
            @endif


        <!-- Formulário -->
        <form method="POST" action="{{ route('plano.create', ['plano_id' => $plano->id]) }}">
            @csrf
            <input type="hidden" id="action_route" name="action_route" value="{{ route('plano.create', ['plano_id' => $plano->id]) }}">

            <!-- Informações Pessoais -->
            <div class="form-section">
                <h4>Informações Pessoais</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select id="categoria" name="categoria" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="Magistério EBTT" {{ (old('categoria', $plano->informacoesPessoais->categoria ?? '') == "Magistério EBTT") ? 'selected' : '' }}>Magistério EBTT</option>
                            <option value="Magistério ES" {{ (old('categoria', $plano->informacoesPessoais->categoria ?? '') == "Magistério ES") ? 'selected' : '' }}>Magistério ES</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="regime" class="form-label">Regime</label>
                        <select id="regime" name="regime" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="20h" {{ (old('regime', $plano->informacoesPessoais->regime ?? '') == "20h") ? 'selected' : '' }}>20h</option>
                            <option value="40h" {{ (old('regime', $plano->informacoesPessoais->regime ?? '') == "40h") ? 'selected' : '' }}>40h</option>
                            <option value="Dedicação Exclusiva" {{ (old('regime', $plano->informacoesPessoais->regime ?? '') == "Dedicação Exclusiva") ? 'selected' : '' }}>Dedicação Exclusiva</option>
                            <option value="Visitante" {{ (old('regime', $plano->informacoesPessoais->regime ?? '') == "Visitante") ? 'selected' : '' }}>Visitante</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Seção Aulas -->
            <div class="form-section">
                <h4>Aulas</h4>
                <div id="aulas-container">
                    <!-- Campos de Aula -->
                </div>
                <button type="button" class="btn btn-add" onclick="addAula()">Adicionar Aula</button>
            </div>

            <!-- Seção Atividades Administrativas -->
            <div class="form-section">
                <h4>Atividades Administrativas</h4>
                <div id="adm-container">
                    <!-- Campos de Atividade Administrativa -->
                </div>
                <button type="button" class="btn btn-add" onclick="addAtividade('adm')">Adicionar Atividade Administrativa</button>
            </div>

            <!-- Seção Atividades de Extensão -->
            <div class="form-section">
                <h4>Atividades de Extensão</h4>
                <div id="ext-container">
                    <!-- Campos de Atividade de Extensão -->
                </div>
                <button type="button" class="btn btn-add" onclick="addAtividade('ext')">Adicionar Atividade de Extensão</button>
            </div>

            <!-- Seção Atividades de Pesquisa -->
            <div class="form-section">
                <h4>Atividades de Pesquisa</h4>
                <div id="pesquisa-container">
                    <!-- Campos de Atividade de Pesquisa -->
                </div>
                <button type="button" class="btn btn-add" onclick="addAtividade('pesquisa')">Adicionar Atividade de Pesquisa</button>
            </div>

            <!-- Seção Atividades de Ensino -->
            <div class="form-section">
                <h4>Atividades de Ensino</h4>
                <div id="ensino-container">
                    <!-- Campos de Atividade de Ensino -->
                </div>
                <button type="button" class="btn btn-add" onclick="addAtividade('ensino')">Adicionar Atividade de Ensino</button>
            </div>

            <!-- Botões de Ação -->
            <div class="mt-4">
                <button type="button" class="btn btn-success w-100" onclick="submitForm('{{ route('plano.create', ['plano_id' => $plano->id]) }}')">Salvar</button>
                <button type="button" class="btn btn-primary w-100 mt-2" onclick="submitForm('{{ route('plano.submitForReview', ['plano_id' => $plano->id]) }}')">Enviar para Avaliação</button>
            </div>
            <input type="hidden" name="plano_id" value="{{ $plano->id }}">
        </form>
    </div>

@endsection

@section('other-js-assets')
    <script>

        function geraId(){
            return Math.floor(Date.now()*(Math.random() * (999999 - 10000 + 1)) + 10000);
        }

        function addAula(disciplina = '', curso = '', ch = '') {
            const container = document.getElementById('aulas-container');
            const aulaId = geraId();
            const aula = `<div class="row mb-3" id="aula-${aulaId}">
                            <div class="col-md-4">
                                <input type="text" name="aulasDisciplinas[]" class="form-control" placeholder="Disciplina" value="${disciplina}" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="aulasCursos[]" class="form-control" placeholder="Curso" value="${curso}" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="aulasCargasHorarias[]" step="0.5" class="form-control" placeholder="Carga Horária" value="${ch}" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-remove" onclick="removeItem('aula-${aulaId}')">Remover Aula</button>
                            </div>
                          </div>`;
            container.insertAdjacentHTML('beforeend', aula);
        }

        function addAtividade(tipo, descricao = '',  portaria = '', ch = ''){
            const container = document.getElementById(`${tipo}-container`);
            const atividadeId = geraId()
            let atividade = '';
            if (tipo === 'adm') {
                atividade = `<div class="row mb-3" id="${tipo}-${atividadeId}">
                                <div class="col-md-4">
                                    <input type="text" name="${tipo}Descricao[]" class="form-control" placeholder="Descrição" value="${descricao}" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="${tipo}Portaria[]" pattern="^\\d+/\\d{4}$" class="form-control" placeholder="Portaria (Ex: 1234/2024)" value="${portaria}" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="${tipo}CargaHoraria[]" step="0.5" class="form-control" placeholder="Carga Horária" value="${ch}" required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="button" class="btn btn-remove" onclick="removeItem('${tipo}-${atividadeId}')">Remover Atividade</button>
                                </div>
                             </div>`;
            } else {
                atividade = `<div class="row mb-3" id="${tipo}-${atividadeId}">
                                <div class="col-md-6">
                                    <input type="text" name="${tipo}Descricao[]" class="form-control" placeholder="Descrição" value="${descricao}" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="${tipo}CargaHoraria[]" step="0.5" class="form-control" placeholder="Carga Horária" value="${ch}" required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="button" class="btn btn-remove" onclick="removeItem('${tipo}-${atividadeId}')">Remover Atividade</button>
                                </div>
                             </div>`;
            }
            container.insertAdjacentHTML('beforeend', atividade);
        }

        function removeItem(id) {
            const item = document.getElementById(id);
            if (item) {
                item.remove();
            }
        }
        function submitForm(actionUrl) {
            const form = document.querySelector('form');
            document.getElementById('action_route').value = actionUrl;
            form.action = actionUrl;
            form.submit();
        }

    </script>

    </script>
    {{-- Código para inserir disciplinas old, se for o caso --}}
    @foreach($plano->aulas as $aula)
        <script>
            console.log('chamando funcao aula');
            addAula(
                '{{ old('aulasDisciplinas.' . $loop->index, $aula->disciplina) }}',
                '{{ old('aulasCursos.' . $loop->index, $aula->curso) }}',
                '{{ old('aulasCargasHorarias.' . $loop->index, $aula->carga_horaria) }}'
            );
        </script>
    @endforeach

    <x-atividades tipo="adm" :plano="$plano" />
    <x-atividades tipo="ext" :plano="$plano" />
    <x-atividades tipo="pesquisa" :plano="$plano" />
    <x-atividades tipo="ensino" :plano="$plano" />


@endsection
