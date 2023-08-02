
{{-- view page for editing the service --}}
@extends('includes.admin')
@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header text-center p-3">
            <h4>Edit Service</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/services/'.$service->id) }}" method="POST">
                @method('PATCH')
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Service Name</label>
                    <input type="text" class="form-control" name="service_name" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ $service->service_name }}">
                    <label for="exampleInputEmail2" class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" id="exampleInputEmail2"
                        aria-describedby="emailHelp" value="{{ $service->price }}">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@stop
