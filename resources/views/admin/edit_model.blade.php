{{-- view page for editing the model --}}

@extends('includes.admin')
@section('content')
    <div class="container">
        <div class="card mt-4">

            <div class="card-header text-center p-3">
                <h4>Edit Model </h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ url('admin/models/' . $brand_id . '/' . $models->id) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" name="brand_id" id="brand_id"
                            aria-describedby="emailHelp" disabled
                            @php $brands = DB::table('brands')->select('*')->where('id',$models->brand_id)->get(); @endphp
                            @foreach ($brands as $brand)
                      value={{ $brand->brand_name }} @endforeach>
                    </div>
                    <div class="mb-3">
                        <label for="model_name" class="form-label">Model Name</label>
                        <input type="text" class="form-control" name="model_name" id="model_name"
                            aria-describedby="emailHelp" value="{{ $models->model_name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
