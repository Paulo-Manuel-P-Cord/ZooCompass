<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Store;
use App\Models\StockCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{


    public function index()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $stores = DB::table('stores')
            ->join('stock_categories', 'stores.category', '=', 'stock_categories.id')
            ->select('stores.*', 'stock_categories.name as category_name')
            ->get();

        // Carrega as categorias para o modal de criação de item
        $categories = StockCategory::all();

        return view('stores.index', compact('stores', 'categories'));
    }



    public function create()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $categories = StockCategory::all();
        return view('stores.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|integer',
            'category' => 'required|integer|exists:stock_categories,id',
        ]);

        // Cria o registro no banco de dados
        Store::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'category' => $request->category,
        ]);

        return redirect()->route('stores.index')->with('success', 'Item de estoque criado com sucesso.');
    }

    public function show(Store $store)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        return view('stores.show', compact('store'));
    }

    public function edit(Store $store)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $categories = StockCategory::all();
        return view('stores.edit', compact('store', 'categories'));
    }

    public function update(Request $request, Store $store)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|integer',
            'category' => 'required|exists:stock_categories,id',
        ]);

        // Atualiza o registro no banco de dados
        $store->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'category' => $request->category,
        ]);

        return redirect()->route('stores.index')->with('success', 'Item de estoque atualizado com sucesso.');
    }

    public function destroy(Store $store)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $store->delete();
        return redirect()->route('stores.index')->with('success', 'Item de estoque deletado com sucesso.');
    }
}