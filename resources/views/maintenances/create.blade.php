<!-- INUTILIZADO -->


@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Criar Nova Manutenção</h1>

    <!-- Formulário -->
    <form action="{{ route('maintenances.store') }}" method="POST" class="row g-3">
        @csrf

        <!-- Descrição -->
        <div class="col-md-6">
            <label for="description" class="form-label">Descrição:</label>
            <input 
                type="text" 
                name="description" 
                id="description" 
                class="form-control" 
                placeholder="Digite a descrição da manutenção" 
                required>
        </div>

        <!-- Data -->
        <div class="col-md-6">
            <label for="date" class="form-label">Data:</label>
            <input 
                type="date" 
                name="date" 
                id="date" 
                class="form-control" 
                required>
        </div>

        <!-- Custo -->
        <div class="col-md-6">
            <label for="cost" class="form-label">Custo:</label>
            <input 
                type="number" 
                name="cost" 
                id="cost" 
                class="form-control" 
                placeholder="Digite o custo da manutenção" 
                required>
        </div>

        <!-- Tipo -->
        <div class="col-md-6">
            <label for="type" class="form-label">Tipo:</label>
            <input 
                type="text" 
                name="type" 
                id="type" 
                class="form-control" 
                placeholder="Digite o tipo da manutenção" 
                required>
        </div>

        <!-- Animal -->
        <div class="col-md-6">
            <label for="animal_id" class="form-label">Animal:</label>
            <select name="animal_id" id="animal_id" class="form-select">
                <option value="">Animal não necessário</option>
                @foreach ($animals as $animal)
                    <option value="{{ $animal->id }}">{{ $animal->animal }}</option>
                @endforeach
            </select>
        </div>

        <!-- Funcionário -->
        <div class="col-md-6">
            <label for="employee_id" class="form-label">Funcionário:</label>
            <select name="employee_id" id="employee_id" class="form-select">
                <option value="">Trabalhador não necessário</option>
                @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}">{{ $worker->name }} ({{ $worker->position->title }})</option>
                @endforeach
            </select>
        </div>

        <!-- Concluída -->
        <div class="col-md-6">
            <label for="completed" class="form-label">Já foi feita?</label>
            <div class="form-check">
                <input 
                    type="checkbox" 
                    name="completed" 
                    id="completed" 
                    value="1" 
                    class="form-check-input">
                <label class="form-check-label" for="completed">Marque se a manutenção foi concluída</label>
            </div>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Criar Manutenção
            </button>
            <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
