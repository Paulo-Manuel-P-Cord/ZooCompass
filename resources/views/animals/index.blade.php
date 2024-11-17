@extends('layouts.app')

@section('content')
    <h1>Lista de Animais</h1>
    <a href="{{ route('animals.create') }}">Adicionar Animal</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <ul>
        @foreach ($animals as $animal)
            <li>
                {{ $animal->animal }} - {{ $animal->habitat }}
                <a href="{{ route('animals.edit', $animal->id) }}">Editar</a>
                <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Deletar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection