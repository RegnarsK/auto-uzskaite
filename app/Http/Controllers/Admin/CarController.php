<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        Car::create($request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
        ]));

        return redirect()->route('admin.cars.index');
    }

    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $car->update($request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
        ]));

        return redirect()->route('admin.cars.index');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index');
    }
}
