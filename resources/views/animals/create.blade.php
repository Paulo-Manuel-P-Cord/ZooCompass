@extends('layouts.app')

@section('content')
    <h1>Criar Novo Animal</h1>

    <form action="{{ isset($animal) ? route('animals.update', $animal->id) : route('animals.store') }}" method="POST">
    @csrf
    @if (isset($animal))
        @method('PUT')
    @endif

    <label for="animal">Nome do Animal:</label>
    <input type="text" name="animal" id="animal" value="{{ old('animal', $animal->animal ?? '') }}" required>

    <label for="diet">Dieta:</label>
    <select name="diet" id="diet" required>
        <option value="1" {{ old('diet', $animal->diet ?? '') == 1 ? 'selected' : '' }}>Carnívoros</option>
        <option value="2" {{ old('diet', $animal->diet ?? '') == 2 ? 'selected' : '' }}>Herbívoros</option>
        <option value="3" {{ old('diet', $animal->diet ?? '') == 3 ? 'selected' : '' }}>Onívoros</option>
        <option value="4" {{ old('diet', $animal->diet ?? '') == 4 ? 'selected' : '' }}>Frugívoros</option>
        <option value="5" {{ old('diet', $animal->diet ?? '') == 5 ? 'selected' : '' }}>Insetívoros</option>
        <option value="6" {{ old('diet', $animal->diet ?? '') == 6 ? 'selected' : '' }}>Piscívoros</option>
    </select>

        <label for="habitat">Habitat:</label>
        <input type="text" name="habitat" id="habitat" required>

        <label for="amount">Quantidade:</label>
        <input type="number" name="amount" id="amount" required>

        <label for="origin">Origem:</label>
        <input type="text" name="origin" id="origin" required>

        <button type="submit">Criar Animal</button>
    </form>
@endsection