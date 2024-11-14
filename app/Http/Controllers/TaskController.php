<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PHPUnit\TextUI\Application;

class TaskController extends Controller
{
    public function index(): View|Factory|Application
    {
        // Fetch tasks for the authenticated user only
        $tasks = Task::query()->where('user_id', Auth::id())->get();
        return view('dashboard', compact('tasks'));
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        Task::query()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $task = Task::query()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function toggleComplete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $task = Task::query()->findOrFail($id);
        $task->completed = (int)$request->input('completed');
        $task->save();

        return response()->json(['success' => true]);
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $task = Task::query()->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $task = Task::query()->findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }
}
