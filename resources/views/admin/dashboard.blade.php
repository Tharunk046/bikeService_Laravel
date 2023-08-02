
{{-- view page for admin dashboard --}}
@extends('includes.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mt-auto">
                <h1>Admin dashboard</h1>
                <h1>Bike service</h1>
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            Total Number of Bookings :
            <span class="badge bg-primary">
                {{ $service_count = DB::table('bookings')->count() }}
            </span>
        </div>
        <div class="alert alert-success" role="alert">
            Total Number of Services :
            <span class="badge bg-primary">
                {{ $service_count = DB::table('services')->count() }}
            </span>
        </div>
        <div class="alert alert-info" role="alert">
            Total Number of Users :
            <span class="badge bg-primary">
                {{ $service_count = DB::table('users')->where('usertype',0)->count() }}
            </span>
        </div>
        <div class="alert alert-danger" role="alert">
            Total Number of Brands :
            <span class="badge bg-primary">
                {{ $service_count = DB::table('brands')->count() }}
            </span>
        </div>
        <div class="alert alert-warning" role="alert">
            Total Number of Models :
            <span class="badge bg-primary">
                {{ $service_count = DB::table('models')->count() }}
            </span>
        </div>

    </div>
@endsection
