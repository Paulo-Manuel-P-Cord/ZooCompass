@extends('layouts.app')

@section('content')
    <h1>Editar Animal</h1>

    <form action="{{ route('animals.update', $animal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="animal">Nome do Animal:</label>
        <input type="text" name="animal" id="animal" value="{{ $animal->animal }}" required>

        <label for="diet">Dieta:</label>
        <input type="number" name="diet" id="diet" value="{{ $animal->diet }}" required>

        <label for="habitat">Habitat:</label>
        <input type="text" name="habitat" id="habitat" value="{{ $animal->habitat }}" required>

        <label for="amount">Quantidade:</label>
        <input type="number" name="amount" id="amount" value="{{ $animal->amount }}" required>

        <label for="origin">Origem:</label>
        <input type="text" name="origin" id="origin" value="{{ $animal->origin }}" required>

        <button type="submit">Atualizar Animal</button>
    </form>
@endsection