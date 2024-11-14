<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <!-- Font Awesome CDN qo'shing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        .btn-primary {
            @apply bg-blue-500 text-dark font-bold py-2 px-4 rounded shadow hover:bg-blue-600 transition duration-300;
        }
        .footer-text {
            @apply text-sm text-gray-300;
        }
        .header-title {
            @apply text-2xl font-bold text-dark;
        }
    </style>
</head>
<body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      :class="{ 'bg-gray-900 text-white': darkMode, 'bg-gray-100 text-black': !darkMode }"
      class="h-screen transition-all duration-300">

<div class="flex h-screen">
    @yield('content')
</div>

{{--<ul>--}}
{{--    @foreach ($tasks as $task)--}}
{{--        @include('partials.task-item', ['task' => $task])--}}
{{--    @endforeach--}}
{{--</ul>--}}

<script src="{{ asset('js/app.js') }}" defer></script>


</body>
</html>
