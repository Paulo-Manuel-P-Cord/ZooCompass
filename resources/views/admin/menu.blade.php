@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4 text-success">Administração</h1>
    <div class="row">
        <!-- Loop pelos módulos agrupados -->
        @foreach ($modules as $module)
            @if ($module['name'] == 'Animals')
                <!-- Card de Animals -->
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
            @elseif ($module['name'] == 'Positions' || $module['name'] == 'Workers')
                @php $isFirst = ($module['name'] == 'Positions'); @endphp
                @if ($isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-success bg-light-green">
                            <div class="card-body">
                                <h5 class="card-title text-success">Trabalhadores</h5>
                                <p class="card-text">Gerencie trabalhadores de forma centralizada.</p>

                                
                                <a href="{{ route('workers.index') }}" class="btn btn-outline-success">Acessar Workers</a>
                            </div>
                        </div>
                        <div class="card shadow-sm border-success bg-light-green">
                            <div class="card-body">
                                <h5 class="card-title text-success">Total de Cargos</h5>
                                <p class="card-text">Gerencie posições de forma centralizada.</p>
                                <h5 class="text-muted">Total de Cargos: {{ $modules[1]['data']['total_positions'] }}</h5>
                                <a href="{{ route('positions.index') }}" class="btn btn-outline-success">Acessar Positions</a>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-success bg-light-green">
                            <div class="card-body">
                                <h5 class="card-title text-success">Detalhes de Workers</h5>
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
            @elseif ($module['name'] == 'Stock Categories' || $module['name'] == 'Stores')
                @php $isFirst = ($module['name'] == 'Stock Categories'); @endphp
                @if ($isFirst)
                    <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-success bg-light-green">
                            <div class="card-body">
                                <h5 class="card-title text-success">estoque</h5>
                                <p class="card-text">Gerencie informações de seu estoque.</p>
                                <a href="{{ route('stores.index') }}" class="btn btn-outline-success">Acessar estoque</a>
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
                        <div class="card shadow-sm border-success bg-light-green">
                            <div class="card-body">
                                <h5 class="card-title text-success">Detalhes de Stores</h5>
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
            @elseif ($module['name'] == 'Maintenances')
                <!-- Card de Maintenances -->
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
