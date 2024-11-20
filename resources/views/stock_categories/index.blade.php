@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Categorias de Estoque</h1>

    <!-- Botão para adicionar nova categoria -->
    <a href="{{ route('stock_categories.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Adicionar Categoria
    </a>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabela de categorias -->
    <div class="table-responsive">
        <table class="table table-success table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <!-- Botão de editar -->
                        <a href="{{ route('stock_categories.edit', $category->id) }}" class="btn btn-outline-success btn-sm me-1">
                            <i class="bi bi-pencil"></i> Editar
                        </a>

                        <!-- Botão de deletar -->
                        <form action="{{ route('stock_categories.destroy', $category->id) }}" method="POST" class="d-inline">
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
