<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('status', 'pending')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function assign(Task $task)
    {
        $task->users()->attach(auth()->id());
        $task->update(['status' => 'assigned']);
        return back();
    }

    public function complete(Task $task)
    {
        $task->update(['status' => 'completed']);
        return back();
    }
}
