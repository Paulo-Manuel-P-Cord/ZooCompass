<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        return view('animals.index', compact('animals'));
    }

    public function create()
    {
        return view('animals.create');
    }

    public function store(Request $request)
{
 
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
        return view('animals.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        return view('animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
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
        $animal->delete();
        return redirect()->route('animals.index')->with('success', 'Animal deletado com sucesso.');
    }
}