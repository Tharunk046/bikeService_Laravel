
{{-- view page for adding new services --}}

@extends('includes.admin')
@section('content')
    <div class="container">
        <div class="card mt-4">
            
            <div class="card-header text-center p-3">
                <h4>Add new Service</h4>
            </div>
            
            <div class="card-body">
                <form action="{{ url('admin/services') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Service Name</label>
                        <input type="text" class="form-control" name="service_name" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                        <label for="exampleInputEmail2" class="form-label">Price</label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail2"
                            aria-describedby="emailHelp" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Service</button>
                </form>
            </div>
        </div>
    </div>
@endsection
