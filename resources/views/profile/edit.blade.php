@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Perfil</h1>

    <!-- Mensagens de Sucesso -->
    @if (session('status') == 'profile-updated')
        <div class="alert alert-success" role="alert">
            Perfil atualizado com sucesso.
        </div>
    @endif
    @if (session('status') == 'password-updated')
        <div class="alert alert-success" role="alert">
            Senha atualizada com sucesso.
        </div>
    @endif

    <!-- Formulário de Atualização de Perfil -->
    <div class="card mb-4 bg-light border-success">
        <div class="card-header bg-success text-white">
            <h3>Atualizar Dados Pessoais</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- Campo de Nome -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
                </div>

                <!-- Campo de Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <!-- Botões de Ação -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100">Atualizar Perfil</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulário para Trocar Senha -->
    <div class="card mb-4 bg-light border-success">
        <div class="card-header bg-success text-white">
            <h3>Trocar Senha</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.change-password') }}">
                @csrf
                @method('PATCH')

                <!-- Campo de Senha Atual -->
                <div class="mb-3">
                    <label for="current_password" class="form-label">Senha Atual</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                </div>

                <!-- Campo de Nova Senha -->
                <div class="mb-3">
                    <label for="new_password" class="form-label">Nova Senha</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>

                <!-- Campo de Confirmação da Nova Senha -->
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirmar Nova Senha</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                </div>

                <!-- Botão de Submissão -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100">Trocar Senha</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulário para Deletar Conta -->
    <div class="card mb-4 bg-light border-danger">
        <div class="card-header bg-danger text-white">
            <h3>Deletar Conta</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <label for="password" class="form-label">Senha Atual</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-danger w-100">Deletar Conta</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
