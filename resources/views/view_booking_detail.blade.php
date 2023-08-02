
{{-- view page for displaying the particular booking detail for user --}}


@extends('includes.app')
@section('content')
    <div class="container">
        <h3 class="text-center"> View Booking </h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    @foreach ($booking_details as $booking_detail)
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>
                                    {{ $booking_detail->id }}
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    {{ $booking_detail->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $booking_detail->email }}</td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td>{{ $booking_detail->phone }}</td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>{{ $booking_detail->address }}</td>
                            </tr>
                            <tr>
                                <td>register number</td>
                                <td>{{ $booking_detail->reg_num }}</td>
                            </tr>
                            <tr>
                                <td>brand</td>
                                {{-- getting the brand name based on brand id --}}
                                @php
                                    $bike_brands = DB::table('brands')
                                        ->select('brand_name')
                                        ->where('id', $booking_detail->brand)
                                        ->get();
                                @endphp
                                @foreach ($bike_brands as $bike_brand)
                                    <td>{{ $bike_brand->brand_name }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>model</td>
                                {{-- getting the model name based on the model id --}}
                                @php
                                    $bike_models = DB::table('models')
                                        ->select('model_name')
                                        ->where('id', $booking_detail->model)
                                        ->get();
                                @endphp
                                @foreach ($bike_models as $bike_model)
                                    <td>{{ $bike_model->model_name }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>services</td>
                                <td>
                                    {{-- getting the service names based on services which are selected by  user --}}
                                    @php
                                        $services = DB::table('services')
                                            ->select('*')
                                            ->get();
                                    @endphp
                                    {{-- services are exploded and displayed using foreach --}}
                                    @foreach (explode(',', $booking_detail->services) as $info)
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
                                <td>{{ date('d-m-Y', strtotime($booking_detail->booking_date)) }}</td>
                            </tr>
                            <tr>
                                <td>created date</td>
                                <td>{{ $booking_detail->created_at }}</td>
                            </tr>
                            <tr>
                                <td>updated date</td>
                                <td>{{ $booking_detail->updated_at }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if ($booking_detail->status == 0)
                                        <span class="badge badge-info">Booked</span>
                                    @elseif ($booking_detail->status == 1)
                                        <span class="badge badge-warning">Ready for delivery</span>
                                    @elseif ($booking_detail->status == 2)
                                        <span class="badge badge-success">Completed</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{ url('view_user_bookings') }}" class="btn btn-primary">Back</a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
