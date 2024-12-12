<!-- resources/views/admin/cars/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Manage Cars</h2>
                    <a href="{{ route('admin.cars.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add New Car
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Make</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active Tasks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($cars as $car)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $car->make }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $car->model }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $car->year }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $car->activeTasks()->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.cars.edit', $car) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        
                                        <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Are you sure you want to delete this car?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($cars->isEmpty())
                        <div class="text-center py-4 text-gray-500">
                            No cars registered yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
