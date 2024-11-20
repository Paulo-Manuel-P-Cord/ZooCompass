<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Animal;
use App\Models\Worker;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $animals = Animal::all(); // Para listar os animais
        $workers = Worker::with('position')->get()->sortBy('position.title'); // Para listar os trabalhadores com cargo, ordenados por cargo
        return view('maintenances.create', compact('animals', 'workers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'type' => 'required|string|max:100',
            'animal_id' => 'nullable|exists:animals,id',
            'employee_id' => 'nullable|exists:workers,id',
            'completed' => 'boolean',
        ]);

        Maintenance::create($request->all());
        return redirect()->route('maintenances.index')->with('success', 'Manutenção criada com sucesso.');
    }

    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $animals = Animal::all(); // Para listar os animais
        $workers = Worker::with('position')->get()->sortBy('position.title'); // Para listar os trabalhadores com cargo, ordenados por cargo
        return view('maintenances.edit', compact('maintenance', 'animals', 'workers'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'type' => 'required|string|max:100',
            'animal_id' => 'nullable|exists:animals,id',
            'employee_id' => 'nullable|exists:workers,id',
            'completed' => 'boolean',
        ]);

        $maintenance->update($request->all());
        return redirect()->route('maintenances.index')->with('success', 'Manutenção atualizada com sucesso.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Manutenção deletada com sucesso.');
    }
}