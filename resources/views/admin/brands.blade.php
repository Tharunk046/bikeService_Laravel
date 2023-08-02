
{{-- view page for displaying the brand list for admin --}}


@extends('includes.admin')
@section('content')
    <div class="container main-content">
        <h3 class="text-center"> Brands </h3>
        @if (Session::has('message'))
            <div class="alert {{ session('color') }} mt-3" role="alert">
                <strong class="text-capitalize">{{ session('message') }}</strong>
            </div>
        @endif
        <a href="{{ url('/admin/brands/create') }}">
            <button class="btn btn-success mt-2 mb-3">Add new Brands</button>
        </a>
        <table class="table table-striped table-hover text-center">
            <thead class="bg-primary text-white p-1">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Brand name</th>
                    <th scope="col"> No of Models</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($brands as $brand)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $brand->brand_name }}</td>
                        <td>
                            <a href="{{ url('admin/models/' . $brand->id) }}">
                                @php
                                    $model_count = DB::table('models')
                                        ->select('*')
                                        ->where('brand_id',$brand->id)
                                        ->count();
                                @endphp
                                Manage Models ({{ $model_count }})
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('admin/brands/' . $brand->id . '/edit') }}" style="text-decoration:none;">
                                <button class="btn btn-warning">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ url('admin/brands/' . $brand->id) }}" method="post" style="display: inline;">
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
        {{ $brands->links() }}
    </div>
@endsection
