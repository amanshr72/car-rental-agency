<x-app-layout>

    <x-slot name="header">
        <div class="text-xl flex font-semibold text-gray-900 sm:text-2xl">
            <span class="flex text-uppercase">
                Available cars
            </span>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">{{session()->get('success')}}</div>
    @elseif (session()->has('danger'))
        <div class="alert alert-danger" role="alert">{{session()->get('danger')}}</div>
    @endif

    <div class="container-xxl bg-white p-6  rounded-t-lg">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($availableCars as $car)
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('path/to/vehicle_images/' . $car->vehicle_image) }}" class="card-img-top" alt="{{ $car->vehicle_model }}">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase">#3b71ca</h5>
                            <p class="card-text">
                                <strong>Vehicle Number:</strong> {{ $car->vehicle_number }}<br>
                                <strong>Seating Capacity:</strong> {{ $car->seating_capacity }}<br>
                                <strong>Rent per Day:</strong> ₹{{ $car->rent_per_day }}
                            </p>
                            @auth
                                <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#rentModal{{ $car->id }}">
                                    Rent Car
                                </button>
                                 <!-- Modal for renting the car start -->
                                <div class="modal fade" id="rentModal{{ $car->id }}" tabindex="-1" aria-labelledby="rentModalLabel{{ $car->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rentModalLabel{{ $car->id }}">Rent this Car</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="pb-3">
                                                    Vehicle Model: {{$car->vehicle_model}} <br> Vehicle Number: {{$car->vehicle_number}}
                                                </div>
                                                <form action="{{ route('booking.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $car->id }}" name="car_id">
                                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                                    
                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="rental_days" name="rental_days" class="form-control" />
                                                        <label class="form-label" for="rental_days">Number of Rental Days</label>
                                                    </div>
                                                    
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <div class="form-outline">
                                                                <input type="date" id="start_date" name="start_date" class="form-control" />
                                                                <label class="form-label" for="start_date">Start Date</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-outline">
                                                                <input type="date" id="end_date" name="end_date" class="form-control" />
                                                                <label class="form-label" for="end_date">End Date</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: #3b71ca">Book</button>
                                                </form>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal for renting the car end -->
                            @else
                                <button class="btn btn-primary mb-2" data-mdb-toggle="modal" data-mdb-target="#exampleFrameModal1-{{$car->id}}" style="">
                                    Rent Car
                                </button>
                                <!-- Modal 2 start  -->
                                <div class="modal frame fade top show" id="exampleFrameModal1-{{$car->id}}" tabindex="-1" aria-labelledby="exampleFrameModal1-{{$car->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-frame modal-top">
                                        <div class="modal-content rounded-0">
                                            <div class="modal-body py-1">
                                            <div class="d-flex justify-content-center align-items-center my-3">
                                                <strong>Warning ! </strong><p class="mx-1">You have to login before book.</p>
                                                <a href="{{route('login')}}" class="btn btn-primary btn-sm ms-2">Go to Login!</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal 2 end  -->
                            @endauth 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>        
        <div class="mt-5"> {{ $availableCars->links() }} </div>
    </div>

</x-app-layout>
