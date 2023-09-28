<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{   
    protected $path;

    public function __construct()
    {
        $this->path = public_path('images/vehicle_images/');
    }

    public function index()
    {   
        $cars = Car::latest()->paginate(10);
        return view('car.index', compact('cars'));
    }

    public function create()
    {
        $cars = null;
        return view('car.create', compact('cars'));
    }

    public function store(Request $request)
    {   
        if ($request->hasFile('image_path')) {
            File::isDirectory($this->path) ?: File::makeDirectory($this->path, 0777, true, true);
            $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048']);
            $image_path = $request->file('image_path');
            $imageName = time() . '.' . $image_path->getClientOriginalExtension();
            $image_path->move($this->path, $imageName);
        } else {
            $imageName = '';
        }

        $request->validate([
            'vehicle_model' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:20',
            'seating_capacity' => 'required|integer|min:2',
            'rent_per_day' => 'required|numeric|min:0',
        ]);

        Car::create([
            'vehicle_model' =>  $request->vehicle_model,
            'vehicle_number' => $request->vehicle_number,
            'seating_capacity' => $request->seating_capacity,
            'rent_per_day' => $request->rent_per_day,
            'image_path' => $imageName
        ]);

        return redirect()->back();
    }

    public function show(Car $car)
    {
        //
    }

    public function edit(string $id)
    {
        $cars = Car::find($id);
        return view('car.create', compact('cars'));
    }

    public function update(Request $request, string $id)
    {   
        if ($request->hasFile('image_path')) {
            File::isDirectory($this->path) ?: File::makeDirectory($this->path, 0777, true, true);
            $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048']);
            $image_path = $request->file('image_path');
            $imageName = time() . '.' . $image_path->getClientOriginalExtension();
            $image_path->move($this->path, $imageName);
        } else {
            $imageName = '';
        }

        $request->validate([
            'vehicle_model' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:20',
            'seating_capacity' => 'required|integer|min:1',
            'rent_per_day' => 'required|numeric|min:0',
        ]);

        Car::where('id', $id)->update([
            'vehicle_model' =>  $request->vehicle_model,
            'vehicle_number' => $request->vehicle_number,
            'seating_capacity' => $request->seating_capacity,
            'rent_per_day' => $request->rent_per_day,
            'image_path' => $imageName,
        ]);
    }

    public function destroy(string $id)
    {
        Car::find($id)->delete();
        return redirect()->back()->with('danger', 'Car Detail has been delated successfully');
    }

    public function availableCars(){
        $availableCars = Car::where('is_booked', 0)->latest()->paginate(9);
        return view('car.available-cars', compact('availableCars'));
    }
}
