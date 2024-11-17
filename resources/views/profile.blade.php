
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-green-600 mb-4">Configurações do Usuário</h2>
    <form action="{{ route('profile.update') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <!-- Nome -->
        <div class="mb-4">
            <label for="name" class="block text-green-600 text-sm font-bold mb-2">Nome</label>
            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <!-- E-mail -->
        <div class="mb-4">
            <label for="email" class="block text-green-600 text-sm font-bold mb-2">E-mail</label>
            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <!-- CPF -->
        <div class="mb-4">
            <label for="cpf" class="block text-green-600 text-sm font-bold mb-2">CPF</label>
            <input type="text" name="cpf" id="cpf" value="{{ auth()->user()->cpf }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Telefone -->
        <div class="mb-4">
            <label for="phone" class="block text-green-600 text-sm font-bold mb-2">Telefone</label>
            <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Data de nascimento -->
        <div class="mb-4">
            <label for="birth" class="block text-green-600 text-sm font-bold mb-2">Data de Nascimento</label>
            <input type="date" name="birth" id="birth" value="{{ auth()->user()->birth }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Botão de envio -->
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Atualizar
            </button>
        </div>
    </form>
</div>
@endsection
