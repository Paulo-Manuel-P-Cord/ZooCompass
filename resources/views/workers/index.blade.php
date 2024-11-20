@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Trabalhadores</h1>

    <!-- Botão para adicionar novo trabalhador -->
    <a href="{{ route('workers.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Criar Funcionário
    </a>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabela de trabalhadores -->
    <div class="table-responsive">
        <table class="table table-success table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Contratação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                    <tr>
                        <td>{{ $worker->name }}</td>
                        <td>{{ $worker->position->title }}</td>
                        <td>{{ $worker->email }}</td>
                        <td>{{ $worker->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($worker->hire_date)->format('d/m/Y') }}</td>
                        <td>
                            <!-- Botão de editar -->
                            <a href="{{ route('workers.edit', $worker->id) }}" class="btn btn-outline-success btn-sm me-1">
                                <i class="bi bi-pencil"></i> Editar
                            </a>

                            <!-- Botão de deletar -->
                            <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar?')">
                                    <i class="bi bi-trash"></i> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
