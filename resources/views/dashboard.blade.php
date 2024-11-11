@extends('layouts.app')

<body class="bg-gray-100 h-screen">
<div class="flex h-screen">
    <div class="w-3/4 p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Добро пожаловать в вашу Панель управления!</h1>
        <p class="text-gray-600">Это ваша панель управления, где вы можете просматривать и управлять своими задачами.</p>

        <div class="flex justify-end mb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none">Выйти</button>
            </form>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="container mx-auto p-4">
                <form method="POST" action="{{ route('tasks.store') }}" class="mb-4 space-y-4">
                    @csrf
                    <input type="text" name="title" placeholder="Название задачи..." required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <textarea name="description" placeholder="Описание задачи..." rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300"></textarea>
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">Добавить</button>
                </form>
                <ul>
                    @foreach ($tasks as $task)
                        <li class="flex flex-col bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 mb-2">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-700 {{ $task->completed ? 'line-through text-gray-400' : '' }}">
                                    {{ $task->title }}
                                </span>
                                <form method="POST" action="{{ route('tasks.toggle', $task->id) }}" class="ml-4">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                                        <i class="fas {{ $task->completed ? 'fa-undo' : 'fa-check' }}"></i> {{ $task->completed ? 'Восстановить' : 'Завершить' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none" onclick="return confirm('Вы действительно хотите удалить эту задачу?');">Удалить</button>
                                </form>
                            </div>
                            <p class="text-gray-600 mt-1">{{ $task->description }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
