<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Editar Item de Estoque</h1>

        <form action="{{ route('stores.update', $store->id) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <!-- Nome do Item -->
            <div class="col-md-6">
                <label for="name" class="form-label">Nome do Item:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $store->name) }}" class="form-control"
                    placeholder="Digite o nome do item" required>
            </div>

            <!-- Quantidade -->
            <div class="col-md-6">
                <label for="amount" class="form-label">Quantidade:</label>
                <input type="number" name="amount" id="amount" value="{{ old('amount', $store->amount) }}"
                    class="form-control" placeholder="Digite a quantidade" required>
            </div>

            <!-- Categoria -->
            <div class="col-md-6">
                <label for="category" class="form-label">Categoria:</label>
                <select name="category" id="category" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category', $store->category) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <!-- Botões de Ações -->
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Atualizar Item
                </button>
                <a href="{{ route('stores.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection