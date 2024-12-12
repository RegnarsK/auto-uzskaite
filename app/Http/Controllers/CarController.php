<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car added successfully.');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $car->update($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        // Check if car has any tasks
        if ($car->tasks()->exists()) {
            return back()->with('error', 'Cannot delete car with associated tasks.');
        }

        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car deleted successfully.');
    }
}
