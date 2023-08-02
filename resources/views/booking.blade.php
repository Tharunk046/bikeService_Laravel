{{-- view page for bboking the service --}}


@extends('includes.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mt-auto">
                <h1>Add Booking</h1>
            </div>
        </div>
    </div>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="/booking" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            {{-- fetching the user detail by using session --}}
                            @php
                                $user_details = DB::table('users')
                                    ->select('*')
                                    ->where('id', Auth::user()->id)
                                    ->get();
                            @endphp
                            @foreach ($user_details as $user_detail)
                            <input type="text" class="form-control" name="client_id" id="client_id"
                                        aria-describedby="emailHelp" hidden value="{{ $user_detail->id }}" required>
                                <div class="mb-3 col-6">
                                    <label for="client_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="client_name" id="name"
                                        aria-describedby="emailHelp" value="{{ $user_detail->name }}" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        aria-describedby="emailHelp" value="{{ $user_detail->phone }}" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="emailHelp" value="{{ $user_detail->email }}" required>
                                </div>
                            @endforeach
                            <div class="mb-3 col-6">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="1" required></textarea>
                            </div>
                            {{-- fetching all brands --}}
                            @php
                                $brands = DB::table('brands')
                                    ->select('*')
                                    ->get();
                            @endphp

                            <div class="mb-3 col-6">
                                <label for="brand" class="form-label">brand</label>
                                <select class="form-select" name="brand" id="brand" 
                                    aria-label="Default select example" required>
                                    <option>Open this select menu</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="model" class="form-label">model</label>
                                <select class="form-control" id="models" name="model" required>
                                    <option >select model</option>
                                </select>
                                <script type="text/javascript">
                                // ajax call for getting the models based on brand id
                                    jQuery(document).ready(function()
                                    {
                                        // onchange event is used to get the brand id value
                                        jQuery('select[name="brand"]').on('change',function(){
                                            var brandId = jQuery(this).val();
                                            console.log(brandId);
                                            if(brandId){
                                                jQuery.ajax({
                                                    // redirection url with brand id
                                                    url : '/getModels/'+brandId,
                                                    // get method is used to get the model values
                                                    type : "GET",
                                                    // datatype is json
                                                    dataType :"json",
                                                    success:function(data){
                                                        // displaying the models
                                                        jQuery('select[name="model"]').empty();
                                                        jQuery.each(data,function(model_name,id){
                                                            $('select[name="model"]').append('<option value="'+ id +'">'+model_name+'</option>');
                                                        });
                                                    }
                                                });
                                            }
                                            else{
                                                $('select[name="model"]').append('<option>"select model"</option>');
                                            }
                                        });
                                    }
                                    );
                                </script>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="reg_num" class="form-label" required>reg_num</label>
                                <input type="text" class="form-control" name="reg_num" id="reg_num"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" onchange="validateDate(event)" name="date"
                                    id="date" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="services" class="form-label">Services: </label>
                                {{-- to fetch all services --}}
                                @php
                                    $services = DB::table('services')
                                        ->select('*')
                                        ->get();
                                @endphp
                                @foreach ($services as $service)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            name="services[]" value="{{ $service->id }}">
                                        <label class="form-check-label"
                                            for="inlineCheckbox1">{{ $service->service_name }}</label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        // to refrine users from booking on previous dates 
        function validateDate(e) {
            let date = new Date(e.target.value)
            let today = new Date()
            if (today > date) {
                document.getElementById('date').value = today.toDateString()
            }
        }
    </script>
@endsection
