@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded-4 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">🛠️ Lista de Manutenções</h2>
                    <div>
                        <!-- Botão para adicionar nova manutenção -->
                        <button class="btn btn-success rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#createMaintenanceModal">
                            <i class="bi bi-plus-circle"></i> Nova Manutenção
                        </button>
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

                {{-- Tabela de manutenções --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center table-bordered table-striped shadow-sm">
                        <thead class="table-dark text-white">
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
                            @forelse ($maintenances as $maintenance)
                                <tr>
                                    <td>{{ $maintenance->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($maintenance->date)->format('d/m/Y') }}</td>
                                    <td>{{ $maintenance->type }}</td>
                                    <td><span class="badge bg-success">R$
                                            {{ number_format($maintenance->cost, 2, ',', '.') }}</span></td>
                                    <td>
                                        @if($maintenance->completed)
                                            <span class="badge bg-success">Concluída</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pendente</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Botão Editar --}}
                                        <button class="btn btn-outline-success btn-sm rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#editMaintenanceModal{{ $maintenance->id }}">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>

                                        {{-- Botão Deletar --}}
                                        <button class="btn btn-outline-danger btn-sm rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#deleteMaintenanceModal{{ $maintenance->id }}">
                                            <i class="bi bi-trash"></i> Deletar
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted">Nenhuma manutenção registrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach ($maintenances as $maintenance)
        <!-- Modal para editar manutenção -->
        <div class="modal fade" id="editMaintenanceModal{{ $maintenance->id }}" tabindex="-1"
            aria-labelledby="editMaintenanceModalLabel{{ $maintenance->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 80px;">
                <div class="modal-content" style="background-color:rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
                    <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                        <h5 class="modal-title" id="editMaintenanceModalLabel{{ $maintenance->id }}">Editar Manutenção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')

                            <!-- Descrição -->
                            <div class="col-md-6">
                                <label for="description{{ $maintenance->id }}" class="form-label">Descrição:</label>
                                <input type="text" name="description" id="description{{ $maintenance->id }}"
                                    value="{{ old('description', $maintenance->description) }}" class="form-control" required>
                            </div>

                            <!-- Data -->
                            <div class="col-md-6">
                                <label for="date{{ $maintenance->id }}" class="form-label">Data:</label>
                                <input type="date" name="date" id="date{{ $maintenance->id }}"
                                    value="{{ old('date', $maintenance->date) }}" class="form-control" required>
                            </div>

                            <!-- Custo -->
                            <div class="col-md-6">
                                <label for="cost{{ $maintenance->id }}" class="form-label">Custo:</label>
                                <input type="number" name="cost" id="cost{{ $maintenance->id }}"
                                    value="{{ old('cost', $maintenance->cost) }}" class="form-control" required>
                            </div>

                            <!-- Tipo -->
                            <div class="col-md-6">
                                <label for="type{{ $maintenance->id }}" class="form-label">Tipo:</label>
                                <input type="text" name="type" id="type{{ $maintenance->id }}"
                                    value="{{ old('type', $maintenance->type) }}" class="form-control" required>
                            </div>

                            <!-- Animal -->
                            <div class="col-md-6">
                                <label for="animal_id{{ $maintenance->id }}" class="form-label">Animal:</label>
                                <select name="animal_id" id="animal_id{{ $maintenance->id }}" class="form-select">
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
                                <label for="employee_id{{ $maintenance->id }}" class="form-label">Funcionário:</label>
                                <select name="employee_id" id="employee_id{{ $maintenance->id }}" class="form-select">
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
                                <label for="completed{{ $maintenance->id }}" class="form-label">Já foi feita?</label>
                                <div class="form-check">
                                    <input type="checkbox" name="completed" id="completed{{ $maintenance->id }}" value="1"
                                        class="form-check-input" {{ old('completed', $maintenance->completed) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="completed{{ $maintenance->id }}">Marque se a manutenção foi concluída</label>
                                </div>
                            </div>

                            <!-- Botões -->
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Atualizar Manutenção
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação de Exclusão -->
        <div class="modal fade" id="deleteMaintenanceModal{{ $maintenance->id }}" tabindex="-1"
            aria-labelledby="deleteMaintenanceModalLabel{{ $maintenance->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border border-danger">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteMaintenanceModalLabel{{ $maintenance->id }}">
                            <i class="bi bi-exclamation-triangle me-2"></i>Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir a manutenção <strong>"{{ $maintenance->description }}"</strong> do dia
                        <strong>{{ \Carbon\Carbon::parse($maintenance->date)->format('d/m/Y') }}</strong>?
                        <br>
                        Esta ação não poderá ser desfeita.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Confirmar Exclusão
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    <!-- Modal para criar manutenção -->
    <div class="modal fade" id="createMaintenanceModal" tabindex="-1" aria-labelledby="createMaintenanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" style="margin-top: 80px;">
            <div class="modal-content" style="background-color:rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
                <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                    <h5 class="modal-title" id="createMaintenanceModalLabel">Criar Nova Manutenção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('maintenances.store') }}" method="POST" class="row g-3">
                        @csrf

                        <!-- Descrição -->
                        <div class="col-md-6">
                            <label for="description" class="form-label">Descrição:</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Digite a descrição da manutenção" required>
                        </div>

                        <!-- Data -->
                        <div class="col-md-6">
                            <label for="date" class="form-label">Data:</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <!-- Custo -->
                        <div class="col-md-6">
                            <label for="cost" class="form-label">Custo:</label>
                            <input type="number" name="cost" id="cost" class="form-control"
                                placeholder="Digite o custo da manutenção" required>
                        </div>

                        <!-- Tipo -->
                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo:</label>
                            <input type="text" name="type" id="type" class="form-control"
                                placeholder="Digite o tipo da manutenção" required>
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
                                    <option value="{{ $worker->id }}">{{ $worker->name }} ({{ $worker->position->title }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Concluída -->
                        <div class="col-md-6">
                            <label for="completed" class="form-label">Já foi feita?</label>
                            <div class="form-check">
                                <input type="checkbox" name="completed" id="completed" value="1" class="form-check-input">
                                <label class="form-check-label" for="completed">Marque se a manutenção foi concluída</label>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Criar Manutenção
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-arrow-left-circle"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection