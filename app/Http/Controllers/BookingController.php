<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('car', 'user')->latest()->paginate(10);
        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $request->validate([
            'rental_days' => 'required|integer|min:1', 
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if(auth()->user()->user_type != "agency"){
            $data = Booking::create([
              'user_id' => $request->user_id,  
              'car_id' => $request->car_id,  
              'rental_days' => $request->rental_days,  
              'start_date' => $request->start_date,  
              'end_date' => $request->end_date,  
            ]);

            Car::where('id', $request->car_id)->update([
                'is_booked' => 1,
            ]);
            
            return redirect()->back()->with('success', 'Congratulations! Your booking has been successfully confirmed. Enjoy your trip!');
        }else{
            return redirect()->back()->with('danger', 'Sorry, You are an agent and now allowed to make bookings.');
        }
    }

    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        //
    }

    public function update(Request $request, Booking $booking)
    {
        //
    }

    public function destroy(Booking $booking)
    {
        //
    }
}
