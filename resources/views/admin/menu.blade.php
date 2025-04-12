@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Título Principal -->
    <h1 class="w-100 my-4 py-3 bg-gradient text-white text-center display-3 rounded-4 shadow-lg">Painel de Administração</h1>

    <div class="row gy-5">

        <!-- Seção: Animais -->
        <h2 class="w-100 py-3 bg-gradient text-white text-center rounded-3 shadow-sm mb-4">Animais</h2>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Animals')
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-success rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $module['name'] }}</h5>
                            <p class="card-text">{{ $module['description'] }}</p>
                            <a href="{{ $module['route'] }}" class="btn btn-outline-success rounded-pill">Acessar</a>
                        </div>
                    </div>
                    <div class="card shadow-lg border-success rounded-3 mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-success">Detalhes de {{ $module['name'] }}</h5>
                            <table class="table table-bordered table-hover table-striped">
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

                <!-- Gráfico de Pizza -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-success rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-success">Distribuição de Espécies por Dieta</h5>
                            <canvas id="animalChart"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const animalCtx = document.getElementById('animalChart').getContext('2d');
                        new Chart(animalCtx, {
                            type: 'pie',
                            data: {
                                labels: {!! json_encode($module['data']['species_by_diet']->pluck('diet')) !!},
                                datasets: [{
                                    data: {!! json_encode($module['data']['species_by_diet']->pluck('species_count')) !!},
                                    backgroundColor: ['#198754', '#dc3545', '#ffc107', '#0dcaf0', '#6f42c1', '#FFA500'],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { position: 'bottom' }
                                }
                            }
                        });
                    });
                </script>
            @endif
        @endforeach

        <!-- Seção: Trabalhadores e Cargos -->
        <h2 class="w-100 py-3 bg-gradient text-white text-center rounded-3 shadow-sm mb-4">Trabalhadores e Cargos</h2>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Positions' || $module['name'] == 'Workers')
                @php $isFirst = ($module['name'] == 'Positions'); @endphp
                @if ($isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-lg border-success rounded-3 mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-success">Trabalhadores</h5>
                                <p class="card-text">Gerencie trabalhadores de forma centralizada.</p>
                                <a href="{{ route('workers.index') }}" class="btn btn-outline-success rounded-pill">Acessar Trabalhadores</a>
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
                        <div class="card shadow-lg border-success rounded-3">
                            <div class="card-body">
                                <h5 class="card-title text-success">Distribuição por Posição</h5>
                                <canvas id="workersChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg border-success rounded-3 mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-success">Detalhes dos Trabalhadores por Cargo</h5>
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th>Cargo</th>
                                        <th>Total de Trabalhadores</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modules[2]['data']['workers_by_position'] as $item)
                                        <tr>
                                            <td>{{ $item->position }}</td>
                                            <td>{{ $item->worker_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const workersCtx = document.getElementById('workersChart').getContext('2d');
                            new Chart(workersCtx, {
                                type: 'pie',
                                data: {
                                    labels: {!! json_encode($module['data']['workers_by_position']->pluck('position')) !!},
                                    datasets: [{
                                        data: {!! json_encode($module['data']['workers_by_position']->pluck('worker_count')) !!},
                                        backgroundColor: ['#198754', '#0d6efd', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#FFA500'],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: { position: 'bottom' }
                                    }
                                }
                            });
                        });
                    </script>
                @endif
            @endif
        @endforeach

        <!-- Seção: Estoque e Categorias -->
        <h2 class="w-100 py-3 bg-gradient text-white text-center rounded-3 shadow-sm mb-4">Estoque e Categorias</h2>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Stock Categories' || $module['name'] == 'Stores')
                @php $isFirst = ($module['name'] == 'Stock Categories'); @endphp
                @if ($isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-lg border-success rounded-3">
                            <div class="card-body">
                                <h5 class="card-title text-success">Estoque</h5>
                                <p class="card-text">Gerencie informações de seu estoque.</p>
                                <a href="{{ route('stores.index') }}" class="btn btn-outline-success rounded-pill">Acessar Estoque</a>
                            </div>
                        </div>

                        <div class="card shadow-lg border-success rounded-3 mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-success">Categoria de Estoque</h5>
                                <p class="card-text">Gerencie suas categorias do estoque.</p>
                                <h5 class="text-muted">Total de Categorias de Estoque: {{ $modules[4]['data']['total_categories'] }}</h5>
                                <a href="{{ route('stock_categories.index') }}" class="btn btn-outline-success rounded-pill">Acessar Categorias</a>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$isFirst)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-lg border-success rounded-3">
                            <div class="card-body">
                                <h5 class="card-title text-success">Itens por Categoria</h5>
                                <canvas id="stockChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg border-success rounded-3 mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-success">Detalhes de Estoque</h5>
                            <table class="table table-bordered table-hover table-striped">
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

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const stockCtx = document.getElementById('stockChart').getContext('2d');
                            new Chart(stockCtx, {
                                type: 'pie',
                                data: {
                                    labels: {!! json_encode($module['data']['stores_by_category']->pluck('category')) !!},
                                    datasets: [{
                                        data: {!! json_encode($module['data']['stores_by_category']->pluck('store_count')) !!},
                                        backgroundColor: ['#198754', '#0d6efd', '#ffc107', '#dc3545', '#6f42c1', '#20c997'],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: { position: 'bottom' }
                                    }
                                }
                            });
                        });
                    </script>
                @endif
            @endif
        @endforeach

        <!-- Seção: Manutenções -->
        <h2 class="w-100 py-3 bg-gradient text-white text-center rounded-3 shadow-sm mb-4">Manutenções</h2>
        @foreach ($modules as $module)
            @if ($module['name'] == 'Maintenances')
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-success rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-success">Manutenções</h5>
                            <p class="card-text">{{ $module['description'] }}</p>
                            <a href="{{ $module['route'] }}" class="btn btn-outline-success rounded-pill">Acessar Manutenções</a>
                        </div>
                    </div>
                    <div class="card shadow-lg border-success rounded-3 mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-success">Detalhes de Manutenções</h5>
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total de Manutenções</td>
                                        <td>{{ $module['data']['total_maintenances'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Manutenções Concluídas</td>
                                        <td>{{ $module['data']['completed_maintenances'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-success rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-success">Resumo das Manutenções</h5>
                            <canvas id="maintenancesChart"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const maintCtx = document.getElementById('maintenancesChart').getContext('2d');
                        new Chart(maintCtx, {
                            type: 'pie',
                            data: {
                                labels: ['Concluídas', 'Pendentes'],
                                datasets: [{
                                    data: [
                                        {{ $module['data']['completed_maintenances'] }},
                                        {{ $module['data']['total_maintenances'] - $module['data']['completed_maintenances'] }}
                                    ],
                                    backgroundColor: ['#198754', '#ffc107'],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { position: 'bottom' }
                                }
                            }
                        });
                    });
                </script>
            @endif
        @endforeach
    </div>
</div>

@endsection
