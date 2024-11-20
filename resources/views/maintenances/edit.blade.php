@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Manutenção</h1>

    <!-- Formulário -->
    <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <!-- Descrição -->
        <div class="col-md-6">
            <label for="description" class="form-label">Descrição:</label>
            <input 
                type="text" 
                name="description" 
                id="description" 
                value="{{ old('description', $maintenance->description) }}" 
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
                value="{{ old('date', $maintenance->date) }}" 
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
                value="{{ old('cost', $maintenance->cost) }}" 
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
                value="{{ old('type', $maintenance->type) }}" 
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
                    <option value="{{ $animal->id }}" {{ old('animal_id', $maintenance->animal_id) == $animal->id ? 'selected' : '' }}>
                        {{ $animal->animal }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Funcionário -->
        <div class="col-md-6">
            <label for="employee_id" class="form-label">Funcionário:</label>
            <select name="employee_id" id="employee_id" class="form-select">
                <option value="">Trabalhador não necessário</option>
                @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}" {{ old('employee_id', $maintenance->employee_id) == $worker->id ? 'selected' : '' }}>
                        {{ $worker->name }} ({{ $worker->position->title }})
                    </option>
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
                    class="form-check-input" 
                    {{ old('completed', $maintenance->completed) ? 'checked' : '' }}>
                <label class="form-check-label" for="completed">Marque se a manutenção foi concluída</label>
            </div>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Atualizar Manutenção
            </button>
            <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
