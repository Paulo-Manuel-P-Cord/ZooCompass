@extends('layouts.app')

@section('content')
    <h1>Detalhes do Trabalhador</h1>

    <p><strong>Nome:</strong> {{ $worker->name }}</p>
    <p><strong>Cargo:</strong> {{ $worker->position }}</p>
    <p><strong>Salário:</strong> {{ $worker->salary }}</p>
    <p><strong>Data de Contratação:</strong> {{ $worker->hire_date }}</p>

    <a href="{{ route('workers.edit', $worker->id) }}">Editar</a>
    <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
    <a href="{{ route('workers.index') }}">Voltar</a>
@endsection