@extends('layouts.clients')
@section('css')
    <link rel="stylesheet" href="{{asset('assets\css\clients\register.css') }}">
@endsection
@section('content')
<div class="container-fluid" id="container-fluid">
    <div class="container-fluid pb-5" id="bg-1">
        <div class="container-fluid bg-1 p-5" id="bg">
            <h1>Register</h1
        </div>
    </div>
    <div class="container-fluid bg-2 p-5 bg-white " id="bg-2">
    </div>
    <div class="container">
    <form method="post" action="{{ route('register') }}">
        @csrf
        <div class="row d-flex justify-content-between pb-2">
            <div class="col-md-6" style="padding: 0;width:48%">
                <label for="username" class="form-label custom-label" style="margin-left: 12px;">UserName</label>
                <input type="text" class="form-control rounded-pill" name="username" id="username" placeholder="Enter your username" value="{{old('username')}}">
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6" style="padding: 0;width:48%">
                <label for="password" class="form-label custom-label" style="margin-left: 12px;">Password</label>
                <input type="password" class="form-control rounded-pill" name="password" id="password" placeholder="Enter your password"value="{{old('password')}}">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row d-flex justify-content-between pb-2">
            <div class="col-md-6" style="padding: 0;width:48%">
                <label for="name" class="form-label custom-label" style="margin-left: 12px;">Name</label>
                <input type="text" class="form-control rounded-pill" name="name" id="name" placeholder="Enter your name"value="{{old('name')}}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6" style="padding: 0;width:48%">
                <label for="phone" class="form-label custom-label" style="margin-left: 12px;">Phone</label>
                <input type="text" class="form-control rounded-pill" name="phone" id="phone" placeholder="x xxx xxx xxx" value="{{old('phone')}}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row pb-2">
            <label for="email" class="form-label custom-label" style="margin-left: 12px;">Email</label>
            <input type="email" class="form-control rounded-pill" name="email" id="email" placeholder="Enter your email" value="{{old('email')}}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="row p-1"></div>
        <div class="row d-flex flex-column align-items-center justify-content-center text-center">
            <p class="">You have an account? <a href="/login">Login now</a></p>
            <button type="submit" class="button">Register</button>
        </div>
    </form>

    </div>
</div>
@endsection
