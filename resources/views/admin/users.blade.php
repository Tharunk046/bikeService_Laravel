{{-- view page for displaying the user list for admin --}}


@extends('includes.admin')
@section('content')
    <div class="container main-content">
        <h3 class="text-center"> Services </h3>
        @if (Session::has('message'))
        <div class="alert {{ session('color') }} mt-3" role="alert">
            <strong class="text-capitalize">{{ session('message') }}</strong> 
        </div>
    @endif
        <table class="table table-striped table-hover text-center">
            <thead class="bg-dark text-white p-1">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ url('admin/users/' . $user->id) }}" method="post"
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
        {{ $users->links() }}
    </div>
@endsection
