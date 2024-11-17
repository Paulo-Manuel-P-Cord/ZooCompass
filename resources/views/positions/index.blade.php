@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Posições</h1>

    <!-- Botão para adicionar nova posição -->
    <a href="{{ route('positions.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Adicionar Posição
    </a>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabela de posições -->
    <div class="table-responsive">
        <table class="table table-success table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $position->title }}</td>
                    <td>{{ $position->description }}</td>
                    <td>
                        <!-- Botão de editar -->
                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-outline-success btn-sm me-1">
                            <i class="bi bi-pencil"></i> Editar
                        </a>

                        <!-- Botão de deletar -->
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
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
