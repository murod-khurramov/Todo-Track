@extends('layouts.app')

<body x-data="{ darkMode: false }" :class="{ 'bg-gray-900 text-white': darkMode, 'bg-gray-100 text-black': !darkMode }" class="h-screen transition-all duration-300">
<div class="flex h-screen">
    <div class="w-3/4 p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-3xl font-bold mb-4">Добро пожаловать в вашу Панель управления!</h1>
            <!-- Dark/Light Mode Toggle Button -->
            <button @click="darkMode = !darkMode" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 focus:outline-none absolute top-4 right-40">
                <span x-show="!darkMode">🌙</span>
                <span x-show="darkMode">☀️</span>
            </button>
        </div>

        <p class="mb-6">Это ваша панель управления, где вы можете просматривать и управлять своими задачами.</p>

        <div class="flex justify-end mb-4">
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="button" onclick="confirmLogout()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none absolute top-4 right-4">
                    Выйти
                </button>
            </form>
        </div>

        <script>
            function confirmLogout() {
                let confirmation = confirm("Вы уверены, что хотите выйти?");
                if (confirmation) {
                    document.getElementById('logout-form').submit();
                }
            }
        </script>

        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="container mx-auto p-4">
                <form method="POST" action="{{ route('tasks.store') }}" class="mb-4 space-y-4">
                    @csrf
                    <input type="text" name="title" placeholder="Название задачи..." required
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none" :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }">
                    <textarea name="description" placeholder="Описание задачи..." rows="3"
                              class="w-full px-3 py-2 border rounded-lg focus:outline-none" :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }"></textarea>
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">Добавить</button>
                </form>

                <ul>
                    @foreach ($tasks as $task)
                        <li class="flex flex-col border rounded-lg px-4 py-2 mb-2" :class="{ 'bg-gray-800 border-gray-700': darkMode, 'bg-gray-50 border-gray-200': !darkMode }">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold" :class="{ 'text-gray-300': darkMode, 'text-gray-700': !darkMode }">
                                    {{ $task->title }}
                                </span>

                                <form method="POST" action="{{ route('tasks.toggle', $task->id) }}" class="ml-4">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                                        <i class="fas {{ $task->completed ? 'fa-undo' : 'fa-check' }}"></i> {{ $task->completed ? 'Восстановить' : 'Завершить' }}
                                    </button>
                                </form>

                                <button type="button" onclick="toggleEditForm({{ $task->id }})" class="text-yellow-500 hover:text-yellow-700 focus:outline-none">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none" onclick="return confirm('Вы действительно хотите удалить эту задачу?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <p class="mt-1" :class="{ 'text-gray-400': darkMode, 'text-gray-600': !darkMode }">{{ $task->description }}</p>

                            <form method="POST" action="{{ route('tasks.update', $task->id) }}" id="edit-form-{{ $task->id }}" class="hidden mt-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="title" value="{{ $task->title }}" required
                                       class="w-full px-3 py-2 border rounded-lg focus:outline-none mb-2" :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }">
                                <textarea name="description" rows="3" required
                                          class="w-full px-3 py-2 border rounded-lg focus:outline-none" :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }">{{ $task->description }}</textarea>
                                <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none">Сохранить</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
<script>
    function toggleEditForm(taskId) {
        const editForm = document.getElementById(`edit-form-${taskId}`);
        editForm.classList.toggle('hidden');
    }
</script>
</body>
