<!-- @extends('layouts.app')

@section('content')
    <h1>Detalhes da Manutenção</h1>

    <p><strong>Descrição:</strong> {{ $maintenance->description }}</p>
    <p><strong>Data:</strong> {{ $maintenance->date }}</p>
    <p><strong>Custo:</strong> {{ $maintenance->cost }}</p>

    <a href="{{ route('maintenances.edit', $maintenance->id) }}">Editar</a>
    <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
    <a href="{{ route('maintenances.index') }}">Voltar</a>
@endsection -->