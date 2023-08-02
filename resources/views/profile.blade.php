
{{-- view page for displaying the profile --}}


@extends('includes.app')

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert {{ session('color') }} mt-3" role="alert">
                <strong class="text-capitalize">{{ session('message') }}</strong>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    @foreach ($userdetail as $profile)
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>
                                    {{ $profile->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $profile->email }}</td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td>{{ $profile->phone }}</td>
                            </tr>
                            <tr>
                                <td>
                                <a href="{{ url('profile/' . $profile->id . '/edit') }}"><button class="btn btn-primary ">
                                        Edit</button>
                                </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
