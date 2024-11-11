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

    public function toggleCompleted($id): \Illuminate\Http\RedirectResponse
    {
        $task = Task::query()->findOrFail($id);
        $task->completed = !$task->completed;
        $task->save();

        return redirect()->route('tasks.index')->with('success');
    }

}
