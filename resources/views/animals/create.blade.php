<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- Título estilizado -->
    <h1 class="w-100 py-3 bg-gradient bg-success text-white text-center rounded-3 shadow-sm mb-4">
        {{ isset($animal) ? 'Editar Animal' : 'Criar Novo Animal' }}
    </h1>

    <!-- Formulário -->
    <form action="{{ isset($animal) ? route('animals.update', $animal->id) : route('animals.store') }}" method="POST" class="row g-4 bg-light p-4 rounded-4 shadow-sm border border-success bg-opacity-25">
        @csrf
        @if (isset($animal))
            @method('PUT')
        @endif

        <!-- Nome do Animal -->
        <div class="col-md-6">
            <label for="animal" class="form-label fw-semibold text-success">Nome do Animal:</label>
            <input 
                type="text" 
                name="animal" 
                id="animal" 
                value="{{ old('animal', $animal->animal ?? '') }}" 
                class="form-control rounded-3 shadow-sm" 
                placeholder="Digite o nome do animal" 
                required>
        </div>

        <!-- Dieta -->
        <div class="col-md-6">
            <label for="diet" class="form-label fw-semibold text-success">Dieta:</label>
            <select name="diet" id="diet" class="form-select rounded-3 shadow-sm" required>
                <option value="" disabled {{ old('diet', $animal->diet ?? '') == '' ? 'selected' : '' }}>Selecione uma dieta</option>
                <option value="1" {{ old('diet', $animal->diet ?? '') == 1 ? 'selected' : '' }}>Carnívoros</option>
                <option value="2" {{ old('diet', $animal->diet ?? '') == 2 ? 'selected' : '' }}>Herbívoros</option>
                <option value="3" {{ old('diet', $animal->diet ?? '') == 3 ? 'selected' : '' }}>Onívoros</option>
                <option value="4" {{ old('diet', $animal->diet ?? '') == 4 ? 'selected' : '' }}>Frugívoros</option>
                <option value="5" {{ old('diet', $animal->diet ?? '') == 5 ? 'selected' : '' }}>Insetívoros</option>
                <option value="6" {{ old('diet', $animal->diet ?? '') == 6 ? 'selected' : '' }}>Piscívoros</option>
            </select>
        </div>

        <!-- Habitat -->
        <div class="col-md-6">
            <label for="habitat" class="form-label fw-semibold text-success">Habitat:</label>
            <input 
                type="text" 
                name="habitat" 
                id="habitat" 
                value="{{ old('habitat', $animal->habitat ?? '') }}" 
                class="form-control rounded-3 shadow-sm" 
                placeholder="Digite o habitat do animal" 
                required>
        </div>

        <!-- Quantidade -->
        <div class="col-md-3">
            <label for="amount" class="form-label fw-semibold text-success">Quantidade:</label>
            <input 
                type="number" 
                name="amount" 
                id="amount" 
                value="{{ old('amount', $animal->amount ?? '') }}" 
                class="form-control rounded-3 shadow-sm" 
                placeholder="Digite a quantidade" 
                required>
        </div>

        <!-- Origem -->
        <div class="col-md-3">
            <label for="origin" class="form-label fw-semibold text-success">Origem:</label>
            <input 
                type="text" 
                name="origin" 
                id="origin" 
                value="{{ old('origin', $animal->origin ?? '') }}" 
                class="form-control rounded-3 shadow-sm" 
                placeholder="Digite a origem" 
                required>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success shadow-sm px-4 me-2 rounded-pill">
                <i class="bi bi-check-circle"></i> {{ isset($animal) ? 'Salvar Alterações' : 'Criar Animal' }}
            </button>
            <a href="{{ route('animals.index') }}" class="btn btn-outline-secondary shadow-sm px-4 rounded-pill">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
