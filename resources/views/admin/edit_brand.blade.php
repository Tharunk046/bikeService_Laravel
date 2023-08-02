
{{-- view page for editing the brand --}}
@extends('includes.admin')
@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header text-center p-3">
                <h4>Edit Brand</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/brands/' . $brand->id) }}" method="POST">
                    @method('PATCH')
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $brand->brand_name }}">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@stop
