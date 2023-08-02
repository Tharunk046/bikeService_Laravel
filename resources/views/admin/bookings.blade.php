{{-- view page for displaying the booking list for admin --}}


@extends('includes.admin')
@section('content')
    <div class="container main-content">
        <h3 class="text-center"> Bookings </h3>
        @if (Session::has('message'))
            <div class="alert {{ session('color') }} mt-3" role="alert">
                <strong class="text-capitalize">{{ session('message') }}</strong>
            </div>
        @endif

        <table class="table table-striped table-hover text-center mt-4">
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
                @foreach ($bookings as $booking)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->name }}</td>
                        <td>
                            @php
                                $services = DB::table('services')
                                    ->select('*')
                                    ->get();
                            @endphp
                            @foreach (explode(',', $booking->services) as $info)
                                @foreach ($services as $service)
                                    @if ($info == $service->id)
                                        {{ $service->service_name . ',' }}
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td>{{ date('d-m-Y', strtotime($booking->booking_date)) }}</td>
                        <td>
                            @if ($booking->status == 0)
                                <span class="badge badge-info">Booked</span>
                            @elseif ($booking->status == 1)
                                <span class="badge badge-warning">Ready for delivery</span>
                            @elseif ($booking->status == 2)
                                <span class="badge badge-success">Completed</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/bookings/' . $booking->id) }}" style="text-decoration:none;">
                                <button class="btn btn-secondary">
                                    View
                                </button>
                            </a>
                            <a href="{{ url('admin/bookings/' . $booking->id . '/edit') }}" style="text-decoration:none;">
                                <button class="btn btn-warning">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ url('admin/bookings/' . $booking->id) }}" method="post"
                                style="display: inline;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bookings->links() }}
    </div>
@endsection
