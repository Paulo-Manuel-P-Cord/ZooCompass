<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\StockCategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Middleware\CheckAdminPosition;

Route::get('/', fn () => view('welcome'));

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/welcome', fn () => view('welcome'))->name('welcome');

// Profile
Route::patch('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Animais
Route::get('/animals', [AnimalController::class, 'index'])->name('animals');
Route::resource('animals', AnimalController::class);

// Posições
Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
Route::resource('positions', PositionController::class);

// Trabalhadores
Route::resource('workers', WorkerController::class);

// Manutenções
Route::resource('maintenances', MaintenanceController::class);

// Categorias de Estoque
Route::resource('stock_categories', StockCategoryController::class);

// Lojas
Route::resource('stores', StoreController::class);

// Admin Menu (protegido por auth e CheckAdminPosition)
Route::get('/admin/menu', function () {
    $animals = [
        'species_by_diet' => \DB::table('animals')
            ->join('animal_type', 'animals.diet', '=', 'animal_type.id')
            ->select('animal_type.diet as diet', \DB::raw('COUNT(DISTINCT animals.id) as species_count'), \DB::raw('SUM(animals.amount) as total_amount'))
            ->groupBy('animal_type.diet')
            ->get(),
    ];

    $positions = [
        'total_positions' => \DB::table('positions')->count(),
    ];

    $workers = [
        'total_workers' => \DB::table('workers')->count(),
        'workers_by_position' => \DB::table('workers')
            ->join('positions', 'workers.position_id', '=', 'positions.id')
            ->select('positions.title as position', \DB::raw('COUNT(workers.id) as worker_count'))
            ->groupBy('positions.title')
            ->get(),
    ];

    $maintenances = [
        'total_maintenances' => \DB::table('maintenances')->count(),
        'completed_maintenances' => \DB::table('maintenances')->where('completed', true)->count(),
    ];

    $stock_categories = [
        'total_categories' => \DB::table('stock_categories')->count(),
    ];

    $stores = [
        'stores_by_category' => \DB::table('stores')
            ->join('stock_categories', 'stores.category', '=', 'stock_categories.id')
            ->select('stock_categories.name as category', \DB::raw('COUNT(stores.id) as store_count'))
            ->groupBy('stock_categories.name')
            ->get(),
    ];

    $modules = [
        [
            'name' => 'Animals',
            'description' => 'Gerencie os registros de animais no sistema.',
            'data' => $animals,
            'route' => route('animals.index'),
        ],
        [
            'name' => 'Positions',
            'description' => 'Gerencie as posições de usuários e permissões.',
            'data' => $positions,
            'route' => route('positions.index'),
        ],
        [
            'name' => 'Workers',
            'description' => 'Gerencie os trabalhadores e suas informações.',
            'data' => $workers,
            'route' => route('workers.index'),
        ],
        [
            'name' => 'Maintenances',
            'description' => 'Controle os registros de manutenção.',
            'data' => $maintenances,
            'route' => route('maintenances.index'),
        ],
        [
            'name' => 'Stock Categories',
            'description' => 'Gerencie as categorias de estoque.',
            'data' => $stock_categories,
            'route' => route('stock_categories.index'),
        ],
        [
            'name' => 'Stores',
            'description' => 'Gerencie as informações das lojas.',
            'data' => $stores,
            'route' => route('stores.index'),
        ],
    ];

    return view('admin.menu', compact('modules'));
})->middleware(['auth', CheckAdminPosition::class])->name('admin.menu');
