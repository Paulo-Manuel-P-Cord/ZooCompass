@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Animais</h1>

    <!-- Botão para adicionar novo animal -->
    <a href="{{ route('animals.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Adicionar Animal
    </a>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabela de animais -->
    <div class="table-responsive">
        <table class="table table-success table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Animal</th>
                    <th>Dieta</th>
                    <th>Habitat</th>
                    <th>Quantidade</th>
                    <th>Origem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($animals as $animal)
        <tr>
            <td>{{ $animal->animal }}</td>
            <td>{{ $animal->diet_name }}</td> <!-- Exibe o nome da dieta -->
            <td>{{ $animal->habitat }}</td>
            <td>{{ $animal->amount }}</td>
            <td>{{ $animal->origin }}</td>
            <td>
                <!-- Botão de editar -->
                <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-outline-success btn-sm me-1"> <!-- Botão de editar verde -->
                                <i class="bi bi-pencil"></i> Editar
                            </a>

                            <!-- Botão de deletar -->
                            <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar?')"> <!-- Botão de deletar com borda vermelha -->
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
