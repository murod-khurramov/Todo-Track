<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    @include('partials.sidebar')
{{--    @include('partials.task_list', ['tasks' => $tasks])--}}
@endsection
<ul>
    @foreach ($tasks as $task)
        @include('partials.task-item', ['task' => $task])
    @endforeach
</ul>
