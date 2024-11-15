<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    @include('partials.sidebar')

    <ul>
        @foreach ($tasks as $task)
            @include('partials.task-item', ['task' => $task])
        @endforeach
    </ul>
@endsection
<ul>
    @forelse ($tasks as $task)
        @include('partials.task-item', ['task' => $task])
    @empty
        <p>Hozircha vazifalar mavjud emas.</p>
    @endforelse
</ul>
