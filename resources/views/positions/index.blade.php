@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded-4 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">📌 Lista de Cargos</h2>
                    <div>
                        <!-- Botão para adicionar nova posição -->
                        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#positionModal">
                            <i class="bi bi-plus-circle"></i> Novo Cargo
                        </button>
                        <!-- Botão para voltar pro menu -->
                        <a href="{{ route('admin.menu') }}" class="btn btn-outline-dark rounded-pill">
                            <i class="bi bi-arrow-left-circle"></i> Voltar ao Menu
                        </a>
                    </div>
                </div>

                <!-- Mensagem de sucesso -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                <!-- Tabela de posições -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center table-bordered table-striped shadow-sm">
                        <thead class="table-dark text-white">
                            <tr>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($positions as $position)
                                <tr>
                                    <td>{{ $position->title }}</td>
                                    <td>{{ $position->description }}</td>
                                    <td>
                                        <!-- Botão de editar -->
                                        <button type="button" class="btn btn-outline-success btn-sm rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#editPositionModal{{ $position->id }}">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>

                                        <!-- Botão de deletar -->
                                        <!-- Botão para abrir o modal de exclusão -->
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deletePositionModal{{ $position->id }}">
                                            <i class="bi bi-trash"></i> Excluir
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Nenhuma posição cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal para criar cargo -->
    <div class="modal fade" id="positionModal" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="margin-top: 80px;">
            <div class="modal-content" style="background-color: rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
                <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                    <h5 class="modal-title" id="positionModalLabel">
                        <i class="bi bi-plus-circle me-2"></i>Adicionar Novo Cargo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <form action="{{ route('positions.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Campo: Título -->
                            <div class="col-md-6">
                                <label for="title" class="form-label">Título:</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
                                    placeholder="Digite o título do cargo" required>
                            </div>

                            <!-- Campo: Descrição -->
                            <div class="col-md-12">
                                <label for="description" class="form-label">Descrição:</label>
                                <textarea name="description" id="description" class="form-control"
                                    placeholder="Digite a descrição do cargo" rows="3"
                                    required>{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Criar Cargo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($positions as $position)
        <!-- Modal de Edição de Cargo -->
        <div class="modal fade" id="editPositionModal{{ $position->id }}" tabindex="-1"
            aria-labelledby="editPositionModalLabel{{ $position->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 80px;">
                <div class="modal-content" style="background-color: rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
                    <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                        <h5 class="modal-title" id="editPositionModalLabel{{ $position->id }}">
                            <i class="bi bi-pencil me-2"></i>Editar Cargo
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <form action="{{ route('positions.update', $position->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="row g-3">
                                <!-- Campo: Título -->
                                <div class="col-md-6">
                                    <label for="title{{ $position->id }}" class="form-label">Título:</label>
                                    <input type="text" name="title" id="title{{ $position->id }}"
                                        value="{{ old('title', $position->title) }}" class="form-control"
                                        placeholder="Digite o título do cargo" required>
                                </div>

                                <!-- Campo: Descrição -->
                                <div class="col-md-12">
                                    <label for="description{{ $position->id }}" class="form-label">Descrição:</label>
                                    <textarea name="description" id="description{{ $position->id }}" class="form-control"
                                        placeholder="Digite a descrição do cargo" rows="3"
                                        required>{{ old('description', $position->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Atualizar Cargo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal de Confirmação de Exclusão de Cargo -->
        <div class="modal fade" id="deletePositionModal{{ $position->id }}" tabindex="-1"
            aria-labelledby="deletePositionModalLabel{{ $position->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border border-danger">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deletePositionModalLabel{{ $position->id }}">
                            <i class="bi bi-exclamation-triangle me-2"></i>Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir o cargo <strong>"{{ $position->title }}"</strong>?
                        <br>
                        Esta ação não poderá ser desfeita.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
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


@endsection