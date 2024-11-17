<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
{
    // Obtém todas as posições do banco de dados
    $positions = Position::all();

    // Retorna a view com a variável $positions
    return view('positions.index', compact('positions'));
}

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255', 
        ]);

        Position::create($request->all());
        return redirect()->route('positions.index')->with('success', 'Posição criada com sucesso.');
    }

    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255', 
        ]);

        $position->update($request->all());
        return redirect()->route('positions.index')->with('success', 'Posição atualizada com sucesso.');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Posição deletada com sucesso.');
    }
}