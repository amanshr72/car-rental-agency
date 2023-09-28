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
        $request->validate([
            'vehicle_model' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:20',
            'description' => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:2',
            'rent_per_day' => 'required|numeric|min:0',
        ]);
        
        if ($request->hasFile('vehicle_image')) {
            File::isDirectory($this->path) ?: File::makeDirectory($this->path, 0777, true, true);
            $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048']);
            $vehicle_image = $request->file('vehicle_image');
            $imageName = time() . '.' . $vehicle_image->getClientOriginalExtension();
            $vehicle_image->move($this->path, $imageName);
        } else {
            $imageName = '';
        }

        Car::create([
            'vehicle_model' =>  $request->vehicle_model,
            'vehicle_number' => $request->vehicle_number,
            'seating_capacity' => $request->seating_capacity,
            'description' => $request->description,
            'rent_per_day' => $request->rent_per_day,
            'vehicle_image' => $imageName
        ]);

        return redirect()->route('car.index')->with('success', 'Car Added Successfully');
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
        $request->validate([
            'vehicle_model' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:20',
            'description' => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:1',
            'rent_per_day' => 'required|numeric|min:0',
        ]);
       
        if ($request->hasFile('vehicle_image')) {
            File::isDirectory($this->path) ?: File::makeDirectory($this->path, 0777, true, true);
            $this->validate($request, ['vehicle_image' => 'image|mimes:jpeg,png,jpg,gif|max:5048',]);
            $vehicle_image = $request->file('vehicle_image');
            $imageName = $request->vehicle_model . '_' . time() . '.' . $vehicle_image->getClientOriginalExtension();
            $vehicle_image->move($this->path, $imageName);

        } else {
            $imageName = '';
        }

        Car::where('id', $id)->update([
            'vehicle_model' =>  $request->vehicle_model,
            'vehicle_number' => $request->vehicle_number,
            'seating_capacity' => $request->seating_capacity,
            'description' => $request->description,
            'rent_per_day' => $request->rent_per_day,
            'vehicle_image' => $imageName,
        ]);

        return redirect()->route('car.index')->with('success', 'Car Updated Successfully');
    }

    public function destroy(string $id)
    {
        Car::find($id)->delete();
        return redirect()->route('car.index')->with('danger', 'Car Detail has been delated successfully');
    }

    public function availableCars(){
        $availableCars = Car::where('is_booked', 0)->latest()->paginate(9);
        return view('car.available-cars', compact('availableCars'));
    }
}
