<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Importa a classe Auth
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    

    public function index()
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }
        $animals = Animal::all();
        

        // Controller - Alteração na query para incluir o JOIN
        $animals = DB::table('animals')
        ->join('animal_type', 'animals.diet', '=', 'animal_type.id')
        ->select('animals.*', 'animal_type.diet as diet_name')
        ->get();
        

        return view('animals.index', compact('animals'));

    }

    public function create()
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        return view('animals.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        $request->validate([
            'animal' => 'required|string|max:100',
            'diet' => 'required|integer|in:1,2,3,4,5,6',
            'habitat' => 'required|string|max:100',
            'amount' => 'required|integer',
            'origin' => 'required|string|max:100',
        ]);

        Animal::create($request->all());

        return redirect()->route('animals.index')->with('success', 'Animal criado com sucesso.');
    }

    public function show(Animal $animal)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        return view('animals.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        return view('animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        $request->validate([
            'animal' => 'required|string|max:100',
            'diet' => 'required|integer',
            'habitat' => 'required|string|max:100',
            'amount' => 'required|integer',
            'origin' => 'required|string|max:100',
        ]);

        $animal->update($request->all());
        return redirect()->route('animals.index')->with('success', 'Animal atualizado com sucesso.');
    }

    public function destroy(Animal $animal)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }
        
        $animal->delete();
        return redirect()->route('animals.index')->with('success', 'Animal deletado com sucesso.');
    }
}
