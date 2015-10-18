@extends('layout')


@section('content')

    <h1>Login:</h1> 
    <hr> 

    <!-- resources/views/auth/login.blade.php -->
    <form method="POST" action="/login">
        {!! csrf_field() !!}

        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>


        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            <input class="form-control" type="password" name="password" id="password">
        </div>


        <div class="form-group">
            <label>
                Remember Me
                <input type="checkbox" name="remember">
            </label>
        </div>

        

        <div class="form-group">
            <button class="btn btn-primary form-control" type="submit">Login</button>
        </div>


        <a href="/login/google" class="btn btn-lg btn-primary btn-block google" type="submit">Google</a>
    
    </form>
    

    @include('errors.list') 


@stop    