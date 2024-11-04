<!-- resources/views/admin/cars/index.blade.php -->
@extends('layouts.dashboard')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Cars</h2>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-success mb-4">Add New Car</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>
                        <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" style="display:inline;">
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
