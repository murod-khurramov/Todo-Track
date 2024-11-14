<!-- resources/views/partials/task_list.blade.php -->
<div class="w-2/3 p-6 overflow-y-auto mt-14">
    <ul>
        @foreach ($tasks as $task)
            <li class="flex items-center space-x-4 border rounded-lg px-4 py-2 mb-2"
                :class="{ 'bg-gray-800 border-gray-700': darkMode, 'bg-gray-50 border-gray-200': !darkMode }">
                <form method="POST" action="{{ route('tasks.toggle', $task->id) }}" class="mr-4">
                    @csrf
                    <button type="submit" class="w-5 h-5 border-2 border-gray-400 rounded-sm focus:outline-none"
                            :class="{ 'bg-green-500 text-white': {{ $task->completed }}, 'bg-transparent': !{{ $task->completed }} }">
                        <span x-show="{{ $task->completed }}" class="block text-center">&#10003;</span>
                    </button>
                </form>

                <div class="flex flex-col w-full">
                    <span class="font-semibold" :class="{ 'text-gray-300': darkMode, 'text-gray-700': !darkMode }">{{ $task->title }}</span>
                    <p class="text-sm mt-1" :class="{ 'text-gray-400': darkMode, 'text-gray-600': !darkMode }">{{ $task->description }}</p>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="toggleEditForm({{ $task->id }})" class="text-yellow-500 hover:text-yellow-700 focus:outline-none">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="ml-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none"
                                onclick="return confirm('Вы действительно хотите удалить эту задачу?');">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('tasks.update', $task->id) }}" id="edit-form-{{ $task->id }}" class="hidden mt-2 w-full">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" value="{{ $task->title }}" required
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none mb-2"
                           :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }">
                    <textarea name="description" rows="3" required
                              class="w-full px-3 py-2 border rounded-lg focus:outline-none"
                              :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }">{{ $task->description }}</textarea>
                    <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none">Сохранить</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
