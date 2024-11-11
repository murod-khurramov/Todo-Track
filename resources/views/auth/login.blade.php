@extends('layouts.app')

<div class="min-h-screen flex items-center justify-center bg-gray-900 text-white">
    <div class="w-full max-w-md bg-gray-800 p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-6">Вход</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Электронная почта</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-300">Пароль</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg">
                Войти
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-400">Нет аккаунта? <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-400">Зарегистрироваться</a></p>
        </div>
    </div>
</div>
