<!-- resources/views/partials/sidebar.blade.php -->
<div class="w-1/3 p-6">
    <div class="flex justify-between mb-4">
        <h1 class="text-3xl font-bold mb-4">Добро пожаловать в вашу Панель управления!</h1>
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 focus:outline-none absolute top-4 right-40">
            <span x-show="!darkMode">🌙</span>
            <span x-show="darkMode">☀️</span>
        </button>
    </div>
    <p class="mb-6">Это ваша панель управления, где вы можете просматривать и управлять своими задачами.</p>
    <div class="flex justify-end mb-4">
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="button" onclick="confirmLogout()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none absolute top-4 right-6">Выйти</button>
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

    <div class="mb-6 space-y-4">
        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="title" placeholder="Название задачи..." required
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none"
                   :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }">
            <textarea name="description" placeholder="Описание задачи..." rows="3"
                      class="w-full px-3 py-2 border rounded-lg focus:outline-none"
                      :class="{ 'bg-gray-800 text-white border-gray-700': darkMode, 'bg-white border-gray-300': !darkMode }"></textarea>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">Добавить</button>
        </form>
    </div>
</div>
