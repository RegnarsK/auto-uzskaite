<!-- resources/views/admin/cars/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold">Edit Car</h2>
                </div>

                <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                        <input type="text" name="make" id="make" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               value="{{ old('make', $car->make) }}" required>
                        @error('make')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" id="model" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               value="{{ old('model', $car->model) }}" required>
                        @error('model')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" name="year" id="year" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               value="{{ old('year', $car->year) }}" 
                               min="1900" max="{{ date('Y') + 1 }}" required>
                        @error('year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.cars.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Car
                        </button>
                    </div>
                </form>

                @if($car->activeTasks()->count() > 0)
                    <div class="mt-6 p-4 bg-yellow-50 rounded-md">
                        <p class="text-yellow-700">
                            <strong>Note:</strong> This car has {{ $car->activeTasks()->count() }} active tasks.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
