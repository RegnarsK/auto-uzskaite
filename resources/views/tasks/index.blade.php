<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.dashboard')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Available Tasks</h2>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Description</th>
                <th>Car</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->car->make }} {{ $task->car->model }} ({{ $task->car->year }})</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>
                        @if($task->status == 'pending')
                            <form action="{{ route('tasks.assign', $task) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Take Task</button>
                            </form>
                        @elseif($task->status == 'assigned')
                            <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Mark as Completed</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
