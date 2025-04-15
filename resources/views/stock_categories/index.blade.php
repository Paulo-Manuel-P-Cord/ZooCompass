@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded-4 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">📦 Categorias de Estoque</h2>
                    <div>
                        <!-- Botão para adicionar nova categoria -->
                        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            <i class="bi bi-plus-circle"></i> Adicionar Categoria
                        </button>

                        <!-- Botão para voltar ao menu -->
                        <a href="{{ route('admin.menu') }}" class="btn btn-outline-dark rounded-pill">
                            <i class="bi bi-arrow-left-circle"></i> Voltar ao Menu
                        </a>
                    </div>
                </div>

                <!-- Alerta de sucesso -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                @endif

                <!-- Tabela de categorias -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center table-bordered table-striped shadow-sm">
                        <thead class="table-dark text-white">
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Botão Editar -->
                                            <button class="btn btn-outline-success btn-sm rounded-pill" data-bs-toggle="modal"
                                                data-bs-target="#editCategoryModal{{ $category->id }}">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>

                                            <!-- Botão Deletar -->
                                            <button class="btn btn-outline-danger btn-sm rounded-pill" data-bs-toggle="modal"
                                                data-bs-target="#deleteCategoryModal{{ $category->id }}">
                                                <i class="bi bi-trash"></i> Deletar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Nenhuma categoria registrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal: Adicionar Categoria -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="margin-top: 80px;">
            <div class="modal-content" style="background-color: rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
                <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                    <h5 class="modal-title" id="categoryModalLabel">
                        <i class="bi bi-plus-circle me-2"></i>Adicionar Nova Categoria de Estoque
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <form action="{{ route('stock_categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Nome da Categoria -->
                            <div class="col-md-12">
                                <label for="name" class="form-label">Nome da Categoria:</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                                    placeholder="Digite o nome da categoria" required>
                            </div>

                            <!-- Descrição -->
                            <div class="col-md-12">
                                <label for="description" class="form-label">Descrição:</label>
                                <textarea name="description" id="description" class="form-control"
                                    placeholder="Digite uma descrição">{{ old('description', 'Não tem descrição') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Criar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($categories as $category)
        <!-- Modal de Edição de Categoria -->
        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
            aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 80px;">
                <div class="modal-content" style="background-color:rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
                    <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                        <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">
                            <i class="bi bi-pencil me-2"></i>Editar Categoria de Estoque
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <form action="{{ route('stock_categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="row g-3">
                                <!-- Nome da Categoria -->
                                <div class="col-md-12">
                                    <label for="name{{ $category->id }}" class="form-label">Nome da Categoria:</label>
                                    <input type="text" name="name" id="name{{ $category->id }}"
                                        value="{{ old('name', $category->name) }}" class="form-control"
                                        placeholder="Digite o nome da categoria" required>
                                </div>

                                <!-- Descrição -->
                                <div class="col-md-12">
                                    <label for="description{{ $category->id }}" class="form-label">Descrição:</label>
                                    <textarea name="description" id="description{{ $category->id }}" class="form-control"
                                        placeholder="Digite uma descrição">{{ old('description', $category->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Atualizar Categoria
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação de Exclusão de Categoria -->
        <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1"
            aria-labelledby="deleteCategoryModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border border-danger">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteCategoryModalLabel{{ $category->id }}">
                            <i class="bi bi-exclamation-triangle me-2"></i>Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir a categoria <strong>{{ $category->name }}</strong>?
                        <br>
                        Esta ação não poderá ser desfeita.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <form action="{{ route('stock_categories.destroy', $category->id) }}" method="POST" class="d-inline">
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