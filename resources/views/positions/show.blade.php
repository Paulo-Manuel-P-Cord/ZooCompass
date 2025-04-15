<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
    <h1>Detalhes da Posição</h1>

    <p><strong>Título:</strong> {{ $position->title }}</p>
    <p><strong>Descrição:</strong> {{ $position->description }}</p>

    <a href="{{ route('positions.edit', $position->id) }}">Editar</a>
    <form action="{{ route('positions.destroy', $position->id) }}" method="POST ```blade
    " style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
    <a href="{{ route('positions.index') }}">Voltar</a>
@endsection