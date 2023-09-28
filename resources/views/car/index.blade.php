<x-app-layout>
    <div class="bg-white p-6  rounded-t-lg">

        <x-slot name=header>
            <div class="text-xl flex font-semibold text-gray-900 sm:text-2xl">
                <span class="flex text-uppercase">
                    All cars
                </span>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('car.create') }}" class="btn btn-success rounded-4" style="background-color: #008000">Add New Car</a>
            </div>
        </x-slot>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{session()->get('success')}} !</div>
        @elseif (session()->has('danger'))
            <div class="alert alert-danger" role="alert">{{session()->get('danger')}} !</div>
        @endif

        @if (count($cars) > 0)
            <table class="table">
                <thead>
                    <tr class="text-uppercase">
                        <th scope="col">S.No.</th>
                        <th scope="col">Vehicle Model</th>
                        <th scope="col">Vehicle Number</th>
                        <th scope="col">Seating Capacity</th>
                        <th scope="col">Rent per Day</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $count++ }}.</td>
                            <td>{{ $car->vehicle_model }}</td>
                            <td>{{ $car->vehicle_number }}</td>
                            <td>{{ $car->seating_capacity }} Person</td>
                            <td>₹{{ $car->rent_per_day }}</td>
                            <td>
                                <a href="{{ route('car.edit', $car->id) }}" class="btn btn-sm btn-primary rounded-3">Update</a>
                                <span class="px-0.5"></span>
                                <a href="{{ route('car.destroy', $car->id) }}" class="btn btn-sm btn-danger rounded-3">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>No available cars at the moment.</p>
                </blockquote>
            </figure>
        @endif

        <div class="mt-5"> {{ $cars->links() }} </div>
    </div>
</x-app-layout>
