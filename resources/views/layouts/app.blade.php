<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body class="bg-gray-100 text-gray-800">
