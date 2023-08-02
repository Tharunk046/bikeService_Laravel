
{{-- view page for creating the new model--}}

@extends('includes.admin')
@section('content')
    <div class="container">
        <div class="card mt-4">

            <div class="card-header text-center p-3">
                <h4>Add new Model </h4>
            </div>
            @php
                $brands = DB::table('brands')
                    ->select('*')
                    ->where('id', $id)
                    ->get();
            @endphp

            <div class="card-body">
                <form action="{{ url('admin/models/' . $id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" name="brand_id" id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                            @foreach ($brands as $brand) value="{{ $brand->brand_name }}" @endforeach disabled>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Model Name</label>
                        <input type="text" class="form-control" name="model_name" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                        
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Model</button>
                </form>
            </div>
        </div>
    </div>
@endsection
