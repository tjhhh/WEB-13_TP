<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Task::create([
            'task_name' => $validated['task_name'],
            'description' => $validated['description'],
            'status' => 'Pending',
        ]);

        return redirect('/')->with('success', 'Task Added Successfully');
    }

    public function edit(Task $task)
    {
        return view('edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Pending,Completed',
        ]);

        $task->update($validated);

        return redirect('/')->with('success', 'Task Edited Successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/')->with('success', 'Task Deleted Successfully');
    }
}