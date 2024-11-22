<?php

namespace App\Http\Controllers;

use App\Models\StockCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class StockCategoryController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $categories = StockCategory::all();
        return view('stock_categories.index', compact('categories'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        return view('stock_categories.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        StockCategory::create($request->all());
        return redirect()->route('stock_categories.index')->with('success', 'Categoria de Estoque criada com sucesso.');
    }

    public function show(StockCategory $category)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        return view('stock_categories.show', compact('category'));
    }

    public function edit(StockCategory $stock_category)
{
    if (!Auth::check() || Auth::user()->position != 1) {
        return redirect()->route('welcome');
    }

    return view('stock_categories.edit', compact('stock_category'));
}

    public function update(Request $request, StockCategory $stock_category)
{
    if (!Auth::check() || Auth::user()->position != 1) {
        return redirect()->route('welcome');
    }


    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);


    $stock_category->update($validated);


    return redirect()
        ->route('stock_categories.index')
        ->with('success', 'Categoria atualizada com sucesso!');
}

    
public function destroy(StockCategory $stock_category)
{
    if (!Auth::check() || Auth::user()->position != 1) {
        return redirect()->route('welcome');
    }
    
    $stock_category->delete();

    return redirect()->route('stock_categories.index')->with('success', 'Categoria excluída com sucesso!');
}
}