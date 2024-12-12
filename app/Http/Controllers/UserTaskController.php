<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    public function index()
    {
        // Get all pending tasks and tasks assigned to the current user
        $tasks = Task::where(function($query) {
            $query->where('status', 'pending')
                  ->orWhereHas('users', function($q) {
                      $q->where('users.id', Auth::id());
                  });
        })
        ->with(['car', 'users'])
        ->latest()
        ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function assign(Task $task)
    {
        // Verify task is still pending
        if ($task->status !== 'pending') {
            return back()->with('error', 'This task is no longer available.');
        }

        // Assign task to current user
        $task->users()->attach(Auth::id());
        $task->update(['status' => 'assigned']);

        return back()->with('success', 'Task has been assigned to you.');
    }

    public function complete(Task $task)
    {
        // Verify task is assigned to current user
        if (!$task->users->contains(Auth::id())) {
            return back()->with('error', 'You are not assigned to this task.');
        }

        // Verify task is in assigned status
        if ($task->status !== 'assigned') {
            return back()->with('error', 'This task cannot be completed.');
        }

        // Mark task as completed
        $task->update(['status' => 'completed']);

        return back()->with('success', 'Task has been marked as completed.');
    }

    public function myTasks()
    {
        // Get all tasks assigned to or completed by the current user
        $tasks = Task::whereHas('users', function($query) {
            $query->where('users.id', Auth::id());
        })
        ->with(['car', 'users'])
        ->latest()
        ->get();

        return view('tasks.my-tasks', compact('tasks'));
    }
}
