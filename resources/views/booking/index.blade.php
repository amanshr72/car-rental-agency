<x-app-layout>
    <div class="bg-white p-6  rounded-t-lg">

        <x-slot name=header>
            <div class="text-xl flex font-semibold text-gray-900 sm:text-2xl">
                <span class="flex text-uppercase">
                    All Bookings
                </span>
            </div>
        </x-slot>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session()->get('success') }} !</div>
        @elseif (session()->has('danger'))
            <div class="alert alert-danger" role="alert">{{ session()->get('danger') }} !</div>
        @endif

        @if (count($bookings) > 0)
            <table class="table">
                <thead>
                    <tr class="text-uppercase">
                        <th scope="col">S.No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Vehicle Model</th>
                        <th scope="col">Vehicle Number</th>
                        <th scope="col">Rent per Day</th>
                        <th scope="col">Rental Days</th>
                        <th scope="col">From date - To date</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $count++ }}.</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->car->vehicle_model }}</td>
                            <td>{{ $booking->car->vehicle_number }}</td>
                            <td>₹{{ $booking->car->rent_per_day }}</td>
                            <td>{{ $booking->rental_days }} Days</td>
                            <td>{{ date('d-M-Y', strtotime($booking->start_date)) }} to {{ date('d-M-Y', strtotime($booking->start_date)) }}</td>
                            {{-- <td>
                                <a href="{{ route('car.edit', $booking->id) }}" class="btn btn-sm btn-primary rounded-3">Update</a>
                                <span class="px-0.5"></span>
                                <a href="{{ route('car.destroy', $booking->id) }}" class="btn btn-sm btn-danger rounded-3">Delete</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>No available bookings at the moment.</p>
                </blockquote>
            </figure>
        @endif

        <div class="mt-5"> {{ $bookings->links() }} </div>
    </div>
</x-app-layout>
