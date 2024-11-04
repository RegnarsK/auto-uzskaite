<!-- resources/views/admin/tasks/index.blade.php -->
@extends('layouts.dashboard')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Tasks</h2>
    <a href="{{ route('admin.tasks.create') }}" class="btn btn-success mb-4">Add New Task</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Description</th>
                <th>Status</th>
                <th>Car</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->car->make }} {{ $task->car->model }} ({{ $task->car->year }})</td>
                    <td>
                        <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
