@extends('layouts.app')

@section('content')
    <h1>Detalhes da Categoria de Estoque</h1>

    <p><strong>Nome:</strong> {{ $category->name }}</p>
    <p><strong>Descrição:</strong> {{ $category->description }}</p>

    <a href="{{ route('stock_categories.edit', $category->id) }}">Editar</a>
    <form action="{{ route('stock_categories.destroy', $category->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
    <a href="{{ route('stock_categories.index') }}">Voltar</a>
@endsection