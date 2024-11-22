<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class WorkerController extends Controller
{

    public function create()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $positions = DB::table('positions')
            ->select('positions.id', 'positions.title') 
            ->get();

        return view('workers.create', compact('positions'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'position_id' => 'required|integer|exists:positions,id',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:100',
            'hire_date' => 'required|date',
        ]);

        Worker::create($request->all());

        return redirect()->route('workers.index')->with('success', 'Trabalhador criado com sucesso.');
    }

    public function index()
    {
        if (!Auth::check() || Auth::user()->position != 1) {
            return redirect()->route('welcome');
        }

        $workers = Worker::with('position')->get(); 
        return view('workers.index', compact('workers'));
    }

    public function edit($id)
{
    if (!Auth::check() || Auth::user()->position != 1) {
        return redirect()->route('welcome');
    }

    $worker = Worker::findOrFail($id);

    $positions = Position::all(); 

    return view('workers.edit', compact('worker', 'positions'));
}


public function destroy($id)
{
    if (!Auth::check() || Auth::user()->position != 1) {
        return redirect()->route('welcome');
    }

    $worker = Worker::findOrFail($id);

    $worker->delete();

    return redirect()->route('workers.index')->with('success', 'Funcionário deletado com sucesso!');
}
public function update(Request $request, $id)
{
    if (!Auth::check() || Auth::user()->position != 1) {
        return redirect()->route('welcome');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:workers,email,' . $id,
        'phone' => 'required|string|max:15',
        'hire_date' => 'required|date',
        'position_id' => 'required|exists:positions,id',
    ]);

    $worker = Worker::findOrFail($id);

    $worker->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'hire_date' => $request->hire_date,
        'position_id' => $request->position_id,
    ]);

    return redirect()->route('workers.index')->with('success', 'Trabalhador atualizado com sucesso!');
}
}