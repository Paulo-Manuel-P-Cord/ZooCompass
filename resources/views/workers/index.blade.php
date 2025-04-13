@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">👷‍♂️ Lista de Trabalhadores</h2>
                <div>
                    <!-- Botão para adicionar novo trabalhador -->
                    <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#createWorkerModal">
    <i class="bi bi-plus-circle"></i> Adicionar Funcionário
</button>
                    <!-- Botão para voltar ao menu -->
                    <a href="{{ route('admin.menu') }}" class="btn btn-outline-dark rounded-pill">
                        <i class="bi bi-arrow-left-circle"></i> Voltar ao Menu
                    </a>
                </div>
            </div>

            {{-- Alerta de sucesso --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            {{-- Tabela de trabalhadores --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-bordered table-striped shadow-sm">
                    <thead class="table-dark text-white">
                        <tr>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Data de Contratação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workers as $worker)
                            <tr>
                                <td>{{ $worker->name }}</td>
                                <td>{{ $worker->position->title }}</td>
                                <td>{{ $worker->email }}</td>
                                <td>{{ $worker->phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($worker->hire_date)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Botão Editar --}}
                                        <button class="btn btn-outline-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#editWorkerModal{{ $worker->id }}">
    <i class="bi bi-pencil"></i> Editar
</button>


                                        {{-- Botão Deletar --}}
                                        <button class="btn btn-outline-danger btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteWorkerModal{{ $worker->id }}">
    <i class="bi bi-trash"></i>Demitir
</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Criação de Funcionário -->
<div class="modal fade" id="createWorkerModal" tabindex="-1" aria-labelledby="createWorkerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 80px;">
        <div class="modal-content" style="background-color: rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">

            <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                <h5 class="modal-title" id="createWorkerModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Criar Novo Funcionário
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="{{ route('workers.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Nome -->
                        <div class="col-md-6">
                            <label for="name" class="form-label text-white">Nome:</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}" 
                                class="form-control" 
                                placeholder="Digite o nome do funcionário" 
                                required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label text-white">Email:</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}" 
                                class="form-control" 
                                placeholder="Digite o email" 
                                required>
                        </div>

                        <!-- Telefone -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label text-white">Telefone:</label>
                            <input 
                                type="text" 
                                name="phone" 
                                id="phone" 
                                value="{{ old('phone') }}" 
                                class="form-control" 
                                placeholder="Digite o telefone" 
                                required>
                        </div>

                        <!-- Data de contratação -->
                        <div class="col-md-6">
                            <label for="hire_date" class="form-label text-white">Data de Contratação:</label>
                            <input 
                                type="date" 
                                name="hire_date" 
                                id="hire_date" 
                                value="{{ old('hire_date') }}" 
                                class="form-control" 
                                required>
                        </div>

                        <!-- Cargo -->
                        <div class="col-md-6">
                            <label for="position_id" class="form-label text-white">Cargo:</label>
                            <select name="position_id" id="position_id" class="form-select" required>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                        {{ $position->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Criar Funcionário
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@foreach ($workers as $worker)
<!-- Modal de Edição de Funcionário -->
<div class="modal fade" id="editWorkerModal{{ $worker->id }}" tabindex="-1" aria-labelledby="editWorkerModalLabel{{ $worker->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 80px;">
        <div class="modal-content" style="background-color: rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
            
            <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                <h5 class="modal-title" id="editWorkerModalLabel{{ $worker->id }}">
                    <i class="bi bi-pencil me-2"></i>Editar Funcionário
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="{{ route('workers.update', $worker->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Nome -->
                        <div class="col-md-6">
                            <label for="name{{ $worker->id }}" class="form-label text-white">Nome:</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name{{ $worker->id }}" 
                                class="form-control" 
                                value="{{ old('name', $worker->name) }}" 
                                required>
                        </div>

                        <!-- Cargo -->
                        <div class="col-md-6">
                            <label for="position_id{{ $worker->id }}" class="form-label text-white">Cargo:</label>
                            <select name="position_id" id="position_id{{ $worker->id }}" class="form-select" required>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ old('position_id', $worker->position_id) == $position->id ? 'selected' : '' }}>
                                        {{ $position->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email{{ $worker->id }}" class="form-label text-white">Email:</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email{{ $worker->id }}" 
                                class="form-control" 
                                value="{{ old('email', $worker->email) }}" 
                                required>
                        </div>

                        <!-- Telefone -->
                        <div class="col-md-6">
                            <label for="phone{{ $worker->id }}" class="form-label text-white">Telefone:</label>
                            <input 
                                type="text" 
                                name="phone" 
                                id="phone{{ $worker->id }}" 
                                class="form-control" 
                                value="{{ old('phone', $worker->phone) }}" 
                                required>
                        </div>

                        <!-- Data de Contratação -->
                        <div class="col-md-6">
                            <label for="hire_date{{ $worker->id }}" class="form-label text-white">Data de Contratação:</label>
                            <input 
                                type="date" 
                                name="hire_date" 
                                id="hire_date{{ $worker->id }}" 
                                class="form-control" 
                                value="{{ old('hire_date', $worker->hire_date) }}" 
                                required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Atualizar Funcionário
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteWorkerModal{{ $worker->id }}" tabindex="-1" aria-labelledby="deleteWorkerModalLabel{{ $worker->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteWorkerModalLabel{{ $worker->id }}">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmar Demição
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja demitir o funcionário <strong>{{ $worker->name }}</strong>?
                <br>
                Esta ação não poderá ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Confirmar Demição
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach
@endsection
