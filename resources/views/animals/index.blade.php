@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">🐾 Lista de Animais</h2>
                <div>
                    <!-- Botão para adicionar novo animal -->
                    <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#animalModal">
                        <i class="bi bi-plus-circle"></i> Adicionar Animal
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

            {{-- Tabela de animais --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-bordered table-striped shadow-sm">
                    <thead class="table-dark text-white">
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
                        @forelse ($animals as $animal)
                            <tr>
                                <td>{{ $animal->animal }}</td>
                                <td>{{ $animal->diet_name }}</td>
                                <td>{{ $animal->habitat }}</td>
                                <td>{{ $animal->amount }}</td>
                                <td>{{ $animal->origin }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Botão Editar --}}
                                        <button 
                                            class="btn btn-outline-success btn-sm rounded-pill" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editAnimalModal{{ $animal->id }}">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>

                                        {{-- Botão Deletar --}}
                                        <button 
                                            class="btn btn-outline-danger btn-sm rounded-pill" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteAnimalModal{{ $animal->id }}">
                                            <i class="bi bi-trash"></i> Deletar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">Nenhum animal registrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@foreach ($animals as $animal)
<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteAnimalModal{{ $animal->id }}" tabindex="-1" aria-labelledby="deleteAnimalModalLabel{{ $animal->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAnimalModalLabel{{ $animal->id }}">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o animal <strong>{{ $animal->animal }}</strong>?
                <br>
                Esta ação não poderá ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" class="d-inline">
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

@foreach ($animals as $animal)
<!-- Modal de Edição -->
<div class="modal fade" id="editAnimalModal{{ $animal->id }}" tabindex="-1" aria-labelledby="editAnimalModalLabel{{ $animal->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 80px;">
        <div class="modal-content" style="background-color:rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
            <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
                <h5 class="modal-title" id="editAnimalModalLabel{{ $animal->id }}">
                    <i class="bi bi-pencil me-2"></i>Editar Animal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form action="{{ route('animals.update', $animal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="animal{{ $animal->id }}" class="form-label">Nome do Animal:</label>
                            <input type="text" name="animal" id="animal{{ $animal->id }}" class="form-control" value="{{ $animal->animal }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="diet{{ $animal->id }}" class="form-label">Dieta:</label>
                            <select name="diet" id="diet{{ $animal->id }}" class="form-select" required>
                                <option value="1" {{ $animal->diet == 1 ? 'selected' : '' }}>Carnívoros</option>
                                <option value="2" {{ $animal->diet == 2 ? 'selected' : '' }}>Herbívoros</option>
                                <option value="3" {{ $animal->diet == 3 ? 'selected' : '' }}>Onívoros</option>
                                <option value="4" {{ $animal->diet == 4 ? 'selected' : '' }}>Frugívoros</option>
                                <option value="5" {{ $animal->diet == 5 ? 'selected' : '' }}>Insetívoros</option>
                                <option value="6" {{ $animal->diet == 6 ? 'selected' : '' }}>Piscívoros</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="habitat{{ $animal->id }}" class="form-label">Habitat:</label>
                            <input type="text" name="habitat" id="habitat{{ $animal->id }}" class="form-control" value="{{ $animal->habitat }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="amount{{ $animal->id }}" class="form-label">Quantidade:</label>
                            <input type="number" name="amount" id="amount{{ $animal->id }}" class="form-control" value="{{ $animal->amount }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="origin{{ $animal->id }}" class="form-label">Origem:</label>
                            <input type="text" name="origin" id="origin{{ $animal->id }}" class="form-control" value="{{ $animal->origin }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Atualizar Animal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal para criar animal -->
<div class="modal fade" id="animalModal" tabindex="-1" aria-labelledby="animalModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" style="margin-top: 80px;">
        <div class="modal-content" style="background-color:rgb(104, 151, 115); border: 2px solid rgb(80, 116, 88);">
        <div class="modal-header" style="background-color: rgb(80, 117, 88); color: white;">
    <h5 class="modal-title" id="animalModalLabel">
        <i class="bi bi-plus-circle me-2"></i>Adicionar Novo Animal
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
            <form action="{{ route('animals.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="animal" class="form-label">Nome do Animal:</label>
                            <input type="text" name="animal" id="animal" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="diet" class="form-label">Dieta:</label>
                            <select name="diet" id="diet" class="form-select" required>
                                <option value="1">Carnívoros</option>
                                <option value="2">Herbívoros</option>
                                <option value="3">Onívoros</option>
                                <option value="4">Frugívoros</option>
                                <option value="5">Insetívoros</option>
                                <option value="6">Piscívoros</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="habitat" class="form-label">Habitat:</label>
                            <input type="text" name="habitat" id="habitat" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="amount" class="form-label">Quantidade:</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="origin" class="form-label">Origem:</label>
                            <input type="text" name="origin" id="origin" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Criar Animal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection