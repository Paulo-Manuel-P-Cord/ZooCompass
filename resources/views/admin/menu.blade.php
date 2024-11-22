@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Título Principal -->
    <h1 class="w-100 my-4 py-2 bg-success text-white text-center display-1">Painel de Administração</h1>

    <div class="row">
        <!-- Seção: Animais -->
        <h1 class="w-100 my-4 py-2 bg-success text-white text-center">Animais</h1>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Animals')
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $module['name'] }}</h5>
                            <p class="card-text">{{ $module['description'] }}</p>
                            <a href="{{ $module['route'] }}" class="btn btn-outline-success">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">Detalhes de {{ $module['name'] }}</h5>
                            <table class="table table-bordered table-hover">
                                <thead class="table-success">
                                    <tr>
                                        <th>Dieta</th>
                                        <th>Espécies</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($module['data']['species_by_diet']->sortByDesc('species_count') as $item)
                                        <tr>
                                            <td>{{ $item->diet }}</td>
                                            <td>{{ $item->species_count }}</td>
                                            <td>{{ $item->total_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Seção: Trabalhadores e Cargos -->
        <h1 class="w-100 my-4 py-2 bg-success text-white text-center">Trabalhadores e Cargos</h1>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Positions' || $module['name'] == 'Workers')
                @php $isFirst = ($module['name'] == 'Positions'); @endphp
                @if ($isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-success mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-success">Trabalhadores</h5>
                                <p class="card-text">Gerencie trabalhadores de forma centralizada.</p>
                                <a href="{{ route('workers.index') }}" class="btn btn-outline-success">Acessar Trabalhadores</a>
                            </div>
                        </div>
			<div class="card shadow-sm border-success bg-light-green">
                            <div class="card-body">
                                <h5 class="card-title text-success">Total de Cargos</h5>
                                <p class="card-text">Gerencie posições de forma centralizada.</p>
                                <h5 class="text-muted">Total de Cargos: {{ $modules[1]['data']['total_positions'] }}</h5>
                                <a href="{{ route('positions.index') }}" class="btn btn-outline-success">Acessar Cargos</a>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-success">
                            <div class="card-body">
                                <h5 class="card-title text-success">Detalhes de Trabalhadores</h5>
                                <table class="table table-bordered table-hover">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Posição</th>
                                            <th>Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($module['data']['workers_by_position']->take(6)->sortByDesc('worker_count') as $item)
                                            <tr>
                                                <td>{{ $item->position }}</td>
                                                <td>{{ $item->worker_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

        <!-- Seção: Estoque e Categorias -->
        <h1 class="w-100 my-4 py-2 bg-success text-white text-center">Estoque e Categorias</h1>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Stock Categories' || $module['name'] == 'Stores')
                @php $isFirst = ($module['name'] == 'Stock Categories'); @endphp
                @if ($isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-success mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-success">Estoque</h5>
                                <p class="card-text">Gerencie informações de seu estoque.</p>
                                <a href="{{ route('stores.index') }}" class="btn btn-outline-success">Acessar Estoque</a>
                            </div>
                        </div>
			<div class="card shadow-sm border-success bg-light-green">
                            <div class="card-body">
                                <h5 class="card-title text-success">Categoria de Estoque</h5>
                                <p class="card-text">Gerencie suas categorias do estoque.</p>
                                <h5 class="text-muted">Total de Categorias de Estoque: {{ $modules[4]['data']['total_categories'] }}</h5>
                                <a href="{{ route('stock_categories.index') }}" class="btn btn-outline-success">Acessar categorias de estoque</a>

                            </div>
                        </div>
                    </div>
                @endif
                @if (!$isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-success">
                            <div class="card-body">
                                <h5 class="card-title text-success">Detalhes de Estoque</h5>
                                <table class="table table-bordered table-hover">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Quantidade de Itens</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($module['data']['stores_by_category']->take(6)->sortByDesc('store_count') as $item)
                                            <tr>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->store_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach

        <!-- Seção: Manutenções -->
        <h1 class="w-100 my-4 py-2 bg-success text-white text-center">Manutenções</h1>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Maintenances')
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">Manutenções</h5>
                            <p class="card-text">{{ $module['description'] }}</p>
                            <a href="{{ $module['route'] }}" class="btn btn-outline-success">Acessar Manutenções</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">Detalhes de Manutenções</h5>
                            <p>Total de Manutenções: {{ $module['data']['total_maintenances'] }}</p>
                            <p>Manutenções Concluídas: {{ $module['data']['completed_maintenances'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
