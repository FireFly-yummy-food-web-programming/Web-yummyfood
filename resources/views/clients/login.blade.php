@extends('layouts.clients')
<link rel="stylesheet" href="{{ asset('assets/css/clients/login.css') }}">
@section('content')
<div class="container-fluid" id="container-fluid">
    <div class="container-fluid pb-5" id="bg-1">
        <div class="container-fluid bg-1 p-5" id="bg">
            <h1 class="text-center">Login</h1>
        </div>
    </div>
    <div class="container-fluid bg-2 p-5 bg-white" id="bg-2">
    </div>
    <div class="container">
        <form action="{{ route('users.login.post') }}" method="post">
            @csrf
            <div class="row">
                <label for="Username" class="col-form-label custom-label">Username</label>
                <input type="text" class="form-control rounded-pill @error('Username') is-invalid @enderror" name="Username" id="Username" value="{{ old('Username') }}" placeholder="Enter the username">
                @error('Username')
                    <span class="text-danger" role="alert">{{ $message }}</span>
                @enderror
                @if (session('error_message') && $errors->has('Username'))
                    <span class="text-danger" role="alert">{{ session('error_message') }}</span>
                @endif
            </div>
            <div class="row">
                <label for="Password" class="col-form-label custom-label">Password</label>
                <input type="password" class="form-control rounded-pill @error('Password') is-invalid @enderror" name="Password" id="Password" value="{{ old('Password') }}" placeholder="Enter the password">
                @error('Password')
                    <span class="text-danger" role="alert">{{ $message }}</span>
                @enderror
                @if (session('error_message') && $errors->has('Password'))
                    <span class="text-danger" role="alert">{{ session('error_message') }}</span>
                @endif
            </div>
            <div class="row d-flex flex-column align-items-center justify-content-center pt-4 text-center">
                <p class="">You don't have an account? <a href="{{route('users.register')}}">Register now</a></p>
                <button type="submit" class="btn btn-primary" style="background-color: #AD343E; border: 1px solid black; border-radius: 118px;">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection