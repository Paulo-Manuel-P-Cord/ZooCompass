@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Itens de Estoque</h1>

    <!-- Botão para adicionar novo item de estoque -->
    <a href="{{ route('stores.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Adicionar Item
    </a>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabela de itens de estoque -->
    <div class="table-responsive">
        <table class="table table-success table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome do Item</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->amount }}</td>
                        <td>{{ $store->category_name ?? 'Sem Categoria' }}</td> <!-- Exibe nome da categoria ou 'Sem Categoria' -->
                        <td>
                            <!-- Botão de editar -->
                            <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-outline-success btn-sm me-1">
                                <i class="bi bi-pencil"></i> Editar
                            </a>

                            <!-- Botão de deletar -->
                            <form action="{{ route('stores.destroy', $store->id) }}" method="POST" class="d-inline">
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
