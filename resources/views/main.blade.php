@extends('layouts.main_layout')

@section('title')
    <title>Plano de Trabalho</title>
@endsection

@section('other-css-assets')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #33a047;
        }
        .navbar .nav-link, .navbar .navbar-brand {
            color: white;
        }
        .navbar .nav-link:hover {
            color: #c72027;
        }
        .form-control:focus {
            border-color: #33a047;
            box-shadow: 0 0 0 0.2rem rgba(51, 160, 71, 0.25);
        }
        .btn-primary {
            background-color: #33a047;
            border-color: #33a047;
        }
        .btn-primary:hover {
            background-color: #28a037;
            border-color: #28a037;
        }
        .btn-danger {
            background-color: #c72027;
            border-color: #c72027;
        }
        .btn-danger:hover {
            background-color: #a51520;
            border-color: #a51520;
        }
    </style>
@endsection

@section('content')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Serviço</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Meus Planos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Notificações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulário -->
    <div class="container mt-5">
        <h2 class="mb-4">Preenchimento de Atividades</h2>
        <form>
            <!-- Informações Pessoais -->
            <div class="mb-4">
                <h4>Informações Pessoais</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select id="categoria" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="EBTT">EBTT</option>
                            <option value="ES">ES</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="regime" class="form-label">Regime</label>
                        <select id="regime" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="20h">20h</option>
                            <option value="40h">40h</option>
                            <option value="DE">DE</option>
                            <option value="Visitante">Visitante</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Aulas -->
            <div class="mb-4">
                <h4>Aulas</h4>
                <div id="aulas-container">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Disciplina" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Curso" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" placeholder="Carga Horária" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="addAula()">Adicionar Aula</button>
            </div>

            <!-- Atividades Administrativas -->
            <div class="mb-4">
                <h4>Atividades Administrativas</h4>
                <div id="adm-container">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Descrição" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Portaria" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" placeholder="Carga Horária" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="addAtividade('adm')">Adicionar Atividade Administrativa</button>
            </div>

            <!-- Atividades de Extensão -->
            <div class="mb-4">
                <h4>Atividades de Extensão</h4>
                <div id="ext-container">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Descrição" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Carga Horária" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="addAtividade('ext')">Adicionar Atividade de Extensão</button>
            </div>

            <!-- Atividades de Pesquisa -->
            <div class="mb-4">
                <h4>Atividades de Pesquisa</h4>
                <div id="pesquisa-container">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Descrição" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Carga Horária" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="addAtividade('pesquisa')">Adicionar Atividade de Pesquisa</button>
            </div>

            <!-- Atividades de Ensino -->
            <div class="mb-4">
                <h4>Atividades de Ensino</h4>
                <div id="ensino-container">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Descrição" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" placeholder="Carga Horária" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="addAtividade('ensino')">Adicionar Atividade de Ensino</button>
            </div>

            <button type="submit" class="btn btn-success w-100">Salvar</button>
        </form>
    </div>

@endsection

@section('other-js-assets')
    <script>
        function addAula() {
            const container = document.getElementById('aulas-container');
            const aulaId = Date.now(); // Gera um ID único
            const aula = `<div class="row mb-3" id="aula-${aulaId}">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Disciplina" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Curso" required>
                        </div>
                        <div class="col-md-4">
                            <input type="number" class="form-control" placeholder="Carga Horária" required>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="button" class="btn btn-danger" onclick="removeAula(${aulaId})">Remover Aula</button>
                        </div>
                    </div>`;
            container.insertAdjacentHTML('beforeend', aula);
        }

        function removeAula(id) {
            const aula = document.getElementById(`aula-${id}`);
            if (aula) {
                aula.remove();
            }
        }

        function addAtividade(tipo) {
            const container = document.getElementById(`${tipo}-container`);
            const atividadeId = Date.now(); // Gera um ID único
            let atividade = '';
            if (tipo === 'adm') {
                atividade = `<div class="row mb-3" id="${tipo}-${atividadeId}">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Descrição" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Portaria" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" placeholder="Carga Horária" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-danger" onclick="removeAtividade('${tipo}', ${atividadeId})">Remover Atividade</button>
                            </div>
                        </div>`;
            } else {
                atividade = `<div class="row mb-3" id="${tipo}-${atividadeId}">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Descrição" required>
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Carga Horária" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-danger" onclick="removeAtividade('${tipo}', ${atividadeId})">Remover Atividade</button>
                            </div>
                        </div>`;
            }
            container.insertAdjacentHTML('beforeend', atividade);
        }

        function removeAtividade(tipo, id) {
            const atividade = document.getElementById(`${tipo}-${id}`);
            if (atividade) {
                atividade.remove();
            }
        }
    </script>
@endsection
