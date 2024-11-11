@extends('layouts.app')
<div class="min-h-screen flex items-center justify-center bg-gray-900 text-white">
    <div class="text-center space-y-8">
        <h1 class="text-4xl md:text-6xl font-bold">
            Добро пожаловать!
        </h1>
        <a href="{{ route('tasks.index') }}" class="px-6 py-3 bg-blue-600 rounded-full text-lg font-semibold hover:bg-blue-700">
            Задачи
        </a>
    </div>
</div>
