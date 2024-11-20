@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Manutenções</h1>

    <!-- Botão para adicionar nova manutenção -->
    <a href="{{ route('maintenances.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Adicionar Manutenção
    </a>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabela de manutenções -->
    <div class="table-responsive">
        <table class="table table-success table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Custo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maintenances as $maintenance)
                    <tr>
                        <td>{{ $maintenance->description }}</td>
                        <td>{{ $maintenance->date }}</td>
                        <td>{{ $maintenance->type }}</td>
                        <td>R$ {{ number_format($maintenance->cost, 2, ',', '.') }}</td>
                        <td>{{ $maintenance->completed ? 'Concluída' : 'Pendente' }}</td>
                        <td>
                            <!-- Botão de editar -->
                            <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="btn btn-outline-success btn-sm me-1">
                                <i class="bi bi-pencil"></i> Editar
                            </a>

                            <!-- Formulário de deletar -->
                            <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" class="d-inline">
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
