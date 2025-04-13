@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">📦 Lista de Itens de Estoque</h2>
                <div>
                    <!-- Botão para adicionar novo item de estoque -->
<button class="btn btn-success rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#storeModal">
    <i class="bi bi-plus-circle"></i> Adicionar Item
</button>

                    <!-- Botão para voltar ao menu -->
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

            <!-- Tabela de itens de estoque -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-bordered table-striped shadow-sm">
                    <thead class="table-dark text-white">
                        <tr>
                            <th>Item</th>
                            <th>Quantidade</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stores as $store)
                            <tr>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->amount }}</td>
                                <td>{{ $store->category_name ?? 'Sem Categoria' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Botão Editar -->
                                        <button type="button" class="btn btn-outline-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#editStoreModal{{ $store->id }}">
            <i class="bi bi-pencil"></i> Editar
        </button>
                                        
                                        <!-- Botão Deletar -->
                                        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteStoreModal{{ $store->id }}">
            <i class="bi bi-trash"></i> Excluir
        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">Nenhum item de estoque registrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<!-- Modal de Criação de Item de Estoque -->
<div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="storeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 80px;">
        <div class="modal-content" style="background-color: rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
            
            <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                <h5 class="modal-title" id="storeModalLabel">
                    <i class="bi bi-plus-circle me-2"></i>Criar Novo Item de Estoque
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="{{ route('stores.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Nome do Item -->
                        <div class="col-md-6">
                            <label for="name" class="form-label text-white">Nome do Item:</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}" 
                                class="form-control" 
                                placeholder="Digite o nome do item" 
                                required>
                        </div>

                        <!-- Quantidade -->
                        <div class="col-md-6">
                            <label for="amount" class="form-label text-white">Quantidade:</label>
                            <input 
                                type="number" 
                                name="amount" 
                                id="amount" 
                                value="{{ old('amount') }}" 
                                class="form-control" 
                                placeholder="Digite a quantidade" 
                                required>
                        </div>

                        <!-- Categoria -->
                        <div class="col-md-6">
                            <label for="category" class="form-label text-white">Categoria:</label>
                            <select name="category" id="category" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
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
                        <i class="bi bi-check-circle"></i> Criar Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@foreach ($stores as $store)
<!-- Modal de Edição -->
<div class="modal fade" id="editStoreModal{{ $store->id }}" tabindex="-1" aria-labelledby="editStoreModalLabel{{ $store->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 80px;">
        <div class="modal-content" style="background-color:rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
            <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                <h5 class="modal-title" id="editStoreModalLabel{{ $store->id }}">
                    <i class="bi bi-pencil me-2"></i>Editar Item de Estoque
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="{{ route('stores.update', $store->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Nome do Item -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nome do Item:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $store->name) }}" required>
                        </div>

                        <!-- Quantidade -->
                        <div class="col-md-6">
                            <label for="amount" class="form-label">Quantidade:</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $store->amount) }}" required>
                        </div>

                        <!-- Categoria -->
                        <div class="col-md-6">
                            <label for="category" class="form-label">Categoria:</label>
                            <select name="category" id="category" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category', $store->category) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
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
                        <i class="bi bi-check-circle"></i> Atualizar Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteStoreModal{{ $store->id }}" tabindex="-1" aria-labelledby="deleteStoreModalLabel{{ $store->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteStoreModalLabel{{ $store->id }}">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o item <strong>{{ $store->name }}</strong>?
                <br>
                Esta ação não poderá ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <form action="{{ route('stores.destroy', $store->id) }}" method="POST" class="d-inline">
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
