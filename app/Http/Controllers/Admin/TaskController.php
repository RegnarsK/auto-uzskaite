<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Car;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('car')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('admin.tasks.create', compact('cars'));
    }

    public function store(Request $request)
    {
        Task::create($request->validate([
            'car_id' => 'required|exists:cars,id',
            'description' => 'required|string',
        ]));

        return redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task)
    {
        $cars = Car::all();
        return view('admin.tasks.edit', compact('task', 'cars'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->validate([
            'car_id' => 'required|exists:cars,id',
            'description' => 'required|string',
            'status' => 'required|string',
        ]));

        return redirect()->route('admin.tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks.index');
    }
}
