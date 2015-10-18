@extends('layout')


@section('content')


    <h1>Register:</h1>
    <hr>

    <!-- resources/views/auth/register.blade.php -->
    {!! Form::open(['action' => 'Auth\AuthController@postRegister']) !!}
    {{-- <form method="POST" action="register"> --}}
    {{-- {!! csrf_field() !!} --}}

        <div class="form-group">
            Name
            <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}">
        </div>


        <div class="form-group">
            Last Name
            <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}">
        </div>



        <div class="form-group">
            Email
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            Password
            <input class="form-control" type="password" name="password">
        </div>

        <div class="form-group">
            Confirm Password
            <input class="form-control" type="password" name="password_confirmation">
        </div>

        <div class="form-group">
            <button class="btn btn-primary form-control" type="submit">Register</button>
        </div>

    {!! Form::close() !!}




    @include('errors.list')



@stop