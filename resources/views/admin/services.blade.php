{{-- view page for displaying the service list for admin --}}


@extends('includes.admin')
@section('content')
    <div class="container main-content">
        <h3 class="text-center"> Services </h3>
        @if (Session::has('message'))
            <div class="alert {{ session('color') }} mt-3" role="alert">
                <strong class="text-capitalize">{{ session('message') }}</strong> 
            </div>
        @endif
        <a href="{{ url('/admin/services/create') }}">
            <button class="btn btn-success mt-2 mb-3">Add new Service</button>
        </a>
        <table class="table table-striped table-hover text-center">
            <thead class="bg-dark text-white p-1">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Service Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ $service->price }}</td>
                        <td>
                            <a href="{{ url('admin/services/' . $service->id . '/edit') }}" style="text-decoration:none;">
                                <button class="btn btn-warning">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ url('admin/services/' . $service->id) }}" method="post"
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
        {{ $services->links() }}
    </div>
@endsection
