<li class="flex items-center space-x-4 border rounded-lg px-4 py-2 mb-2"
    :class="{ 'bg-gray-800 border-gray-700': darkMode, 'bg-gray-50 border-gray-200': !darkMode }">
    <form method="POST" action="{{ route('tasks.toggle', $task->id) }}" class="mr-4 toggle-form">
        @csrf
        <input type="checkbox" @click="toggleTask({{ $task->id }})" {{ $task->completed ? 'checked' : '' }}
        class="checkbox w-5 h-5 border-2 border-gray-400 rounded-sm focus:outline-none">
    </form>
    <div class="flex flex-col w-full">
        <span :class="{ 'line-through': {{ $task->completed }} }">{{ $task->title }}</span>
    </div>
    <!-- Edit and Delete icons -->
    <div class="flex space-x-2">
        <!-- Edit icon -->
        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-edit"></i>
        </a>
        <!-- Delete icon -->
        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</li>
