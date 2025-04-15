<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Editar Trabalhador</h1> <!-- Título -->

        <!-- Formulário -->
        <form action="{{ route('workers.update', $worker->id) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <!-- Nome -->
            <div class="col-md-6">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $worker->name) }}" class="form-control"
                    placeholder="Digite o nome do trabalhador" required>
            </div>

            <!-- Cargo -->
            <div class="col-md-6">
                <label for="position_id" class="form-label">Cargo:</label>
                <select name="position_id" id="position_id" class="form-select" required>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id', $worker->position_id) == $position->id ? 'selected' : '' }}>
                            {{ $position->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $worker->email) }}" class="form-control"
                    placeholder="Digite o email do trabalhador" required>
            </div>

            <!-- Telefone -->
            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone:</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $worker->phone) }}" class="form-control"
                    placeholder="Digite o telefone do trabalhador" required>
            </div>

            <!-- Data de Contratação -->
            <div class="col-md-6">
                <label for="hire_date" class="form-label">Data de Contratação:</label>
                <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', $worker->hire_date) }}"
                    class="form-control" required>
            </div>

            <!-- Botão de Envio e Botão Cancelar -->
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Atualizar Trabalhador
                </button>
                <a href="{{ route('workers.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection