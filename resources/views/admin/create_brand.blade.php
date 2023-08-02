
{{-- view page for creating new brand --}}

@extends('includes.admin')
@section('content')
    <div class="container">
        <div class="card mt-4">
            
            <div class="card-header text-center p-3">
                <h4>Add new Brand</h4>
            </div>
             
            <div class="card-body">
                <form action="{{ url('admin/brands') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                        
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Brand</button>
                </form>
            </div>
        </div>
    </div>
@endsection
