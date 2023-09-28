<x-app-layout>

    <x-slot name=header>
        <a href="{{route('car.index')}}" class="text-xl flex font-semibold text-gray-900 sm:text-2xl">
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 mt-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
                Add New Car
            </span>
        </a>
    </x-slot>

    <div class="container-xxl bg-white p-6  rounded-t-lg">

        <form action="{{ $cars ? route('car.update', $cars->id) : route('car.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($cars) @method('PUT') @endif
            
            <div class="form-group py-2">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="vehicle_model">Vehicle Model</label>
                    </div>
                    <div class="col-6">
                        <x-input name="vehicle_model" id="vehicle_model" value="{{ old('vehicle_model', $cars ? $cars->vehicle_model : '') }}" placeholder="Enter Vehicle Model" />
                        <input-box-error for="vehicle_model" />
                    </div>
                </div>
            </div>
            <div class="form-group py-2">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="vehicle_number">Vehicle Number</label>
                    </div>
                    <div class="col-6">
                        <x-input name="vehicle_number" id="vehicle_number" value="{{ old('vehicle_number', $cars ? $cars->vehicle_number : '') }}" placeholder="Enter Vehicle Number" />
                        <input-box-error for="vehicle_number" />
                    </div>
                </div>
            </div>
            <div class="form-group py-2">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="seating_capacity">Seating Capacity</label>
                    </div>
                    <div class="col-6">
                        <x-input name="seating_capacity" id="seating_capacity" value="{{ old('seating_capacity', $cars ? $cars->seating_capacity : '') }}" placeholder="Enter Seating Capacity" />
                        <input-box-error for="seating_capacity" />
                    </div>
                </div>
            </div>
            <div class="form-group py-2">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="rent_per_day">Rent per Day</label>
                    </div>
                    <div class="col-6">
                        <x-input name="rent_per_day" id="rent_per_day" value="{{ old('rent_per_day', $cars ? $cars->rent_per_day : '') }}" placeholder="Enter Rent per Day" />
                        <input-box-error for="rent_per_day" />
                    </div>
                </div>
            </div>
            <div class="form-group py-2">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <label for="image_path">Upload Image</label>
                    </div>
                    <div class="col-6">
                        <x-input type="file" name="image_path" id="image_path" />
                        @if(isset($cars->image_path))
                            <a href="{{asset('images/vehicle_images/'. $cars->image_path)}}" target="_blank">view file</a>
                        @endif
                        <input-box-error for="image_path" />
                    </div>
                </div>
            </div>
            
            <div class="form-group py-2">
                <div class="row justify-content-center">
                    <div class="col-6 offset-2">
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-success" style="background-color: #008000" type="submit">Submit</button>
                            <a href="{{route('car.index')}}" class="btn btn-light" style="background-color: #a9d6c0" type="button">Discard</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
