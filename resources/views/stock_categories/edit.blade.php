<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Editar Categoria de Estoque</h1> <!-- Título -->

        <!-- Formulário -->
        <form action="{{ route('stock_categories.update', $stock_category->id) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <!-- Nome da Categoria -->
            <div class="col-md-12">
                <label for="name" class="form-label">Nome da Categoria:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $stock_category->name) }}"
                    class="form-control" placeholder="Digite o nome da categoria" required>
            </div>

            <!-- Descrição -->
            <div class="col-md-12">
                <label for="description" class="form-label">Descrição:</label>
                <textarea name="description" id="description" class="form-control"
                    placeholder="Digite uma descrição">{{ old('description', $stock_category->description) }}</textarea>
            </div>

            <!-- Botão de Envio e Botão Cancelar -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Atualizar Categoria
                </button>
                <a href="{{ route('stock_categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection