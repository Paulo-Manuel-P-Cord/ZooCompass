<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class WorkerController extends Controller
{
    // Método para mostrar o formulário de criação
    public function create()
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        // Aqui usamos um JOIN, mas normalmente você só precisaria da tabela positions
        $positions = DB::table('positions')
            ->select('positions.id', 'positions.title') // Seleciona o ID e o título
            ->get();

        return view('workers.create', compact('positions'));
    }

    // Método para armazenar o trabalhador
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'position_id' => 'required|integer|exists:positions,id',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:100',
            'hire_date' => 'required|date',
        ]);

        // Cria o trabalhador com os dados do request
        Worker::create($request->all());

        return redirect()->route('workers.index')->with('success', 'Trabalhador criado com sucesso.');
    }

    // Método para listar os trabalhadores (opcional)
    public function index()
    {
        if (!Auth::check() || Auth::id() !== 1) {
            return redirect()->route('login');
        }

        $workers = Worker::with('position')->get(); // Carrega os trabalhadores e suas posições
        return view('workers.index', compact('workers'));
    }

    public function edit($id)
{
    if (!Auth::check() || Auth::id() !== 1) {
        return redirect()->route('login');
    }

    // Recupera o trabalhador pelo ID
    $worker = Worker::findOrFail($id);

    // Recupera todos os cargos disponíveis
    $positions = Position::all(); // ou outro método apropriado para carregar os cargos

    // Retorna a view com os dados necessários
    return view('workers.edit', compact('worker', 'positions'));
}


public function destroy($id)
{
    if (!Auth::check() || Auth::id() !== 1) {
        return redirect()->route('login');
    }

    // Recupera o trabalhador pelo ID
    $worker = Worker::findOrFail($id);

    // Deleta o trabalhador
    $worker->delete();

    // Redireciona de volta com mensagem de sucesso
    return redirect()->route('workers.index')->with('success', 'Funcionário deletado com sucesso!');
}
public function update(Request $request, $id)
{
    if (!Auth::check() || Auth::id() !== 1) {
        return redirect()->route('login');
    }
    
    // Validação dos dados enviados
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:workers,email,' . $id,
        'phone' => 'required|string|max:15',
        'hire_date' => 'required|date',
        'position_id' => 'required|exists:positions,id',
    ]);

    // Recupera o trabalhador pelo ID
    $worker = Worker::findOrFail($id);

    // Atualiza os dados
    $worker->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'hire_date' => $request->hire_date,
        'position_id' => $request->position_id,
    ]);

    // Redireciona com mensagem de sucesso
    return redirect()->route('workers.index')->with('success', 'Trabalhador atualizado com sucesso!');
}
}