{{-- view page for editing the booking status --}}


@extends('includes.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mt-auto">
                <h1>Update Booking</h1>
            </div>
        </div>
    </div>
    .<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="{{ url('admin/bookings/' . $booking->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="mb-3 col-md-6">
                        <label for="client_name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="client_name" id="name"
                            aria-describedby="emailHelp" disabled value="{{ $booking->name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" name="mobile" id="mobile"
                            aria-describedby="emailHelp" disabled value="{{ $booking->phone }}">
                    </div>
                    @php
                        $bike_brands = DB::table('brands')
                            ->select('brand_name')
                            ->where('id', $booking->brand)
                            ->get();
                    @endphp
                    <div class="mb-3 col-6">
                        <label for="mobile" class="form-label">bike Brand</label>
                        @foreach ($bike_brands as $bike_brand)
                            <input type="text" class="form-control" name="brand" id="brand"
                                aria-describedby="emailHelp" disabled
                                value="{{ $bike_brand->brand_name }}">
                        @endforeach
                    </div>
                    @php
                        $bike_models = DB::table('models')
                            ->select('model_name')
                            ->where('id', $booking->model)
                            ->get();
                    @endphp
                    <div class="mb-3 col-6">
                        <label for="mobile" class="form-label">bike Model</label>
                        @foreach ($bike_models as $bike_model)
                            <input type="text" class="form-control" name="model" id="model"
                                aria-describedby="emailHelp" disabled
                                value="{{ $bike_model->model_name }}">
                        @endforeach
                    </div>
                    
                    <div class="mb-3 col-12">
                        <label for="services" class="form-label">Services: </label>
                        @php
                            $services = DB::table('services')
                                ->select('*')
                                ->get();
                        @endphp
                        @foreach ($services as $service)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="services[]"
                                    value="{{ $service->id }}"
                                    @foreach (explode(',', $booking->services) as $info)
                                    @if ($service->id == $info) {{ 'checked' }} @endif @endforeach disabled>
                                <label class="form-check-label" for="inlineCheckbox1">{{ $service->service_name }}</label>
                            </div>
                        @endforeach

                    </div>
                    <div class="mb-3 col-6">
                        <label for="status" class="form-label">status</label>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option value="0" @if ($booking->status == 0) {{ 'selected' }} @endif>Booked
                            </option>
                            <option value="1" @if ($booking->status == 1) {{ 'selected' }} @endif>Ready for delivery
                            </option>
                            <option value="2" @if ($booking->status == 2) {{ 'selected' }} @endif>Completed
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
