{{-- view page for displaying the service list for user --}}

@extends('includes.app')
@section('content')
    <div class="container main-content">
        <h3 class="text-center"> Services </h3>
        <table class="table table-striped table-hover mt-5 text-center">
            <thead class="bg-dark text-white p-1">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Service Name</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ $service->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $services->links() }}
        <a href="{{ url('/book_service') }}">
            <button class="btn btn-success booking-btn btn-xl mt-4">Book Service</button>
        </a>
    </div>
@endsection
