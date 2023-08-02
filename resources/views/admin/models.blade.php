{{-- view page for displaying the model list based on brand id for admin --}}


@extends('includes.admin')
@section('content')
    <div class="container main-content">
        <h3 class="text-center"> Models </h3>
        @if (Session::has('message'))
            <div class="alert {{ session('color') }} mt-3" role="alert">
                <strong class="text-capitalize">{{ session('message') }}</strong>
            </div>
        @endif
        <a href="{{ url('/admin/models/' . $brand_id . '/create') }}">
            <button class="btn btn-success mt-2 mb-3">Add new Model</button>
        </a>
        <table class="table table-striped table-hover text-center">
            <thead class="bg-success text-white p-1">
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">Brand name</th>
                    <th scope="col">Model name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($models as $model)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            @php
                                $brands = DB::table('brands')
                                    ->select('*')
                                    ->where('id', $brand_id)
                                    ->get();
                            @endphp
                            @foreach ($brands as $brand )
                                {{ $brand->brand_name }}
                            @endforeach
                        </td>
                        <td>{{ $model->model_name }}</td>

                        <td>
                            <a href="{{ url('admin/models/' . $brand_id . '/' . $model->id . '/edit') }}"
                                style="text-decoration:none;">
                                <button class="btn btn-warning">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ url('admin/models/' . $model->id . '/' . $brand_id) }}" method="post"
                                style="display: inline;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $models->links() }}
    </div>
@endsection
