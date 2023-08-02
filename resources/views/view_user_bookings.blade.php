{{-- displaying the booking history to users --}}

@extends('includes.app')
@section('content')
    <div class="container main-content">
        <h3 class="text-center"> Bookings </h3>
        <table class="table table-striped table-hover mt-5 text-center">
            <thead class="bg-dark text-white p-1">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Services</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_bookings as $user_booking)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user_booking->id }}</td>
                        <td>{{ $user_booking->name }}</td>
                        <td>
                            @php
                                $services = DB::table('services')
                                    ->select('*')
                                    ->get();
                            @endphp
                            @foreach (explode(',', $user_booking->services) as $info)
                                @foreach ($services as $service)
                                    @if ($info == $service->id)
                                        {{ $service->service_name . ',' }}
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td>{{ date('d-m-Y', strtotime($user_booking->booking_date)) }}</td>
                        <td>
                            @if ($user_booking->status == 0)
                                <span class="badge badge-info">Booked</span>
                            @elseif ($user_booking->status == 1)
                                <span class="badge badge-warning">Ready for delivery</span>
                            @elseif ($user_booking->status == 2)
                                <span class="badge badge-success">Completed</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('view_booking_details/' . $user_booking->id) }}" style="text-decoration:none;">
                                <button class="btn btn-secondary">
                                    View
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $user_bookings->links() }}
    </div>
@endsection
