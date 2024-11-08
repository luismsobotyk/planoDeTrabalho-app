<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link href="{{ asset('assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon" type="image/vnd.microsoft.icon">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="text-center mb-4">
                <img src="{{ asset('assets/images/logo_horizontal_fundo_branco.jpg') }}" id="logo" class="logo">
            </div>
            @if(session('loginError'))
                <div class="alert alert-danger text-center">
                    {{ session('loginError') }}
                </div>
            @endif
            <form action="/loginSubmit" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Seu usuário" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Sua senha" value="{{ old('password') }}" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login w-100 text-white">Entrar</button>
            </form>
            <div class="text-center mt-3">
                <a href="https://senhas.poa.ifrs.edu.br/?action=sendtoken"  target="_blank" class="forgot-password">Esqueceu sua senha?</a>
            </div>

        </div>
    </div>
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
