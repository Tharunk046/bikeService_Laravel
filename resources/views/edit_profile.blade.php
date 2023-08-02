
{{-- view page for editing the user profile --}}

@extends('includes.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mt-auto">
                <h1>Edit Profile</h1>
            </div>
        </div>
    </div>
    .<div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-8">
                <form  method="POST" action="{{ url('profile/'.$profile->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" value="{{ $profile->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile</label>
                        <input type="text" class="form-control" name="phone" id="mobile" aria-describedby="emailHelp" value="{{ $profile->phone }}">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{ $profile->email }}">
                      </div>
                    <button type="submit" class="btn btn-primary">Edit Profile</button>
                  </form>
            </div>
        </div>
    </div>
    
@endsection