{{-- view page for displaying the particular booking detail --}}

@extends('includes.admin')
@section('content')
    <div class="container">
        <h3 class="text-center"> View Booking </h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td>
                                {{ $bookings->id }}
                            </td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>
                                {{ $bookings->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $bookings->email }}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>{{ $bookings->phone }}</td>
                        </tr>
                        <tr>
                            <td>address</td>
                            <td>{{ $bookings->address }}</td>
                        </tr>
                        <tr>
                            <td>register number</td>
                            <td>{{ $bookings->reg_num }}</td>
                        </tr>
                        <tr>
                            <td>brand</td>
                            @php
                            $bike_brands = DB::table('brands')
                                ->select('brand_name')
                                ->where('id',$bookings->brand)
                                ->get();
                        @endphp
                        @foreach ($bike_brands as $bike_brand)
                        <td>{{$bike_brand->brand_name}}</td>
                        @endforeach
                        </tr>
                        <tr>
                            <td>model</td>
                            @php
                                $bike_models = DB::table('models')
                                    ->select('model_name')
                                    ->where('id',$bookings->model)
                                    ->get();
                            @endphp
                            @foreach ($bike_models as $bike_model)
                            <td>{{$bike_model->model_name}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>services</td>
                            <td>
                                @php
                                    $services = DB::table('services')
                                        ->select('*')
                                        ->get();
                                @endphp
                                @foreach (explode(',', $bookings->services) as $info)
                                    @foreach ($services as $service)
                                        @if ($info == $service->id)
                                            {{ $service->service_name . ',' }}
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Booking date</td>
                            <td>{{   date('d-m-Y', strtotime($bookings->booking_date)); }}</td>
                        </tr>
                        <tr>
                            <td>created date</td>
                            <td>{{ $bookings->created_at }}</td>
                        </tr>
                        <tr>
                            <td>updated date</td>
                            <td>{{ $bookings->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if ($bookings->status == 0)
                          <span class="badge badge-info">Booked</span>
                          @elseif ($bookings->status == 1)
                          <span class="badge badge-warning">Ready for delivery</span>
                          @elseif ($bookings->status == 2)
                          <span class="badge badge-success">Completed</span>
                          @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ url('admin/bookings') }}" class="btn btn-primary">Back</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
