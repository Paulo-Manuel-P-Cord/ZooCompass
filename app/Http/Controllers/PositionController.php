<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{

    public function index()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }


        $positions = Position::all();


        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }
        return view('positions.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
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
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
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
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Posição deletada com sucesso.');
    }
}