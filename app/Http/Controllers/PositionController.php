<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class PositionController extends Controller
{
    
    public function index()
{
    if (!Auth::check() || Auth::id() !== 1) {
        return redirect()->route('login');
    }

    // Obtém todas as posições do banco de dados
    $positions = Position::all();

    // Retorna a view com a variável $positions
    return view('positions.index', compact('positions'));
}

    public function create()
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }
        return view('positions.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255', 
        ]);

        Position::create($request->all());
        return redirect()->route('positions.index')->with('success', 'Posição criada com sucesso.');
    }

    public function show(Position $position)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255', 
        ]);

        $position->update($request->all());
        return redirect()->route('positions.index')->with('success', 'Posição atualizada com sucesso.');
    }

    public function destroy(Position $position)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }
        
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Posição deletada com sucesso.');
    }
}