<!-- INUTILIZADO -->

@extends('layouts.app')

@section('content')
    <h1>Detalhes do Item de Estoque</h1>

    <p><strong>Nome:</strong> {{ $store->name }}</p>
    <p><strong>Quantidade:</strong> {{ $store->amount }}</p>
    <p><strong>Categoria:</strong> {{ $store->category->name }}</p>

    <a href="{{ route('stores.edit', $store->id) }}">Editar</a>
    <form action="{{ route('stores.destroy', $store->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
    <a href="{{ route('stores.index') }}">Voltar</a>
@endsection