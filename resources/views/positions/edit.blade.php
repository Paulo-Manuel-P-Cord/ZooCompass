<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Posição</h1> <!-- Título -->

    <!-- Formulário -->
    <form action="{{ route('positions.update', $position->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <!-- Título da Posição -->
        <div class="col-md-6">
            <label for="title" class="form-label">Título:</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ old('title', $position->title) }}" 
                class="form-control" 
                placeholder="Digite o título da posição" 
                required>
        </div>

        <!-- Descrição -->
        <div class="col-md-12">
            <label for="description" class="form-label">Descrição:</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control" 
                placeholder="Digite a descrição da posição" 
                rows="3" 
                required>{{ old('description', $position->description) }}</textarea>
        </div>

        <!-- Botão de Envio e Botão Cancelar -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Atualizar Posição
            </button>
            <a href="{{ route('positions.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
