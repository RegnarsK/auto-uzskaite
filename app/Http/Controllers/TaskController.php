<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Car;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['car', 'users'])->latest()->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('admin.tasks.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'description' => 'required|string|max:255',
        ]);

        $validated['status'] = 'pending';

        Task::create($validated);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $cars = Car::all();
        return view('admin.tasks.edit', compact('task', 'cars'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'description' => 'required|string|max:255',
            'status' => 'required|in:pending,assigned,completed',
        ]);

        $task->update($validated);

        // If the task is marked as completed, update the user_tasks relationship
        if ($validated['status'] === 'completed' && $task->users()->exists()) {
            // We don't detach the user, we keep the record for history
            // but the status will show it's completed
        }

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
