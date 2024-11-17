@extends('layouts.app')

@section('content')
    <h1>Editar Posição</h1>

    <form action="{{ route('positions.update', $position->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="{{ $position->title }}" required>

        <label for="description">Descrição:</label>
        <input type="text" name="description" id="description" value="{{ $position->description }}"> <!-- Alterado para 'description' -->

        <button type="submit">Atualizar Posição</button>
    </form>
@endsection