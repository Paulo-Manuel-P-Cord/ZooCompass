<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Criar Nova Categoria de Estoque</h1> <!-- Título em destaque -->

    <!-- Formulário -->
    <form action="{{ route('stock_categories.store') }}" method="POST" class="row g-3">
        @csrf

        <!-- Nome da Categoria -->
        <div class="col-md-12">
            <label for="name" class="form-label">Nome da Categoria:</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                class="form-control" 
                placeholder="Digite o nome da categoria" 
                required>
        </div>

        <!-- Descrição -->
        <div class="col-md-12">
            <label for="description" class="form-label">Descrição:</label>
            <textarea 
                type="text" 
                name="description" 
                id="description" 
                value="{{ old('description', 'Não tem descrição') }}" 
                class="form-control" 
                placeholder="Digite uma descrição"></textarea>
        </div>

        <!-- Botão de Envio e Botão Cancelar -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Criar Categoria
            </button>
            <a href="{{ route('stock_categories.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
