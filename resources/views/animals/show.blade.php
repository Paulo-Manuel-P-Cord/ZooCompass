<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
    <h1>Detalhes do Animal</h1>

    <p><strong>Nome:</strong> {{ $animal->animal }}</p>
    <p><strong>Dieta:</strong> {{ $animal->diet }}</p>
    <p><strong>Habitat:</strong> {{ $animal->habitat }}</p>
    <p><strong>Quantidade:</strong> {{ $animal->amount }}</p>
    <p><strong>Origem:</strong> {{ $animal->origin }}</p>

    <a href="{{ route('animals.edit', $animal->id) }}">Editar</a>
    <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
    <a href="{{ route('animals.index') }}">Voltar</a>
@endsection