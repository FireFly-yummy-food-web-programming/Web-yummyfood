@extends('layouts.admin')
@section('content')
@if(session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">Input data is invalid. Please check again</div>
@endif
<h3>{{$title}}</h3>
<hr>
<form action="" method="POST">
    @csrf

    <div class="mb-3">
        {{-- <label for="">User id</label> --}}
        <input type="hidden" name="user_id" class="form-control" id="username-input" placeholder="user_id" value="{{old('user_id') ?? $user->user_id }}" disable>
    </div>

    <div class="mb-3">
        <label for="">Username</label>
        <input type="text" name="Username" class="form-control" id="username-input" placeholder="Username" value="{{old('Username') ?? $user->Username }}">
        @error('Username')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Password</label>
        <input type="password" name="Password" class="form-control" id="password-input" placeholder="Password" value="{{old('Password') ?? $user->Password }}">
        @error('Password')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Name</label>
        <input type="text" name="Name" class="form-control" id="name-input" placeholder="Name" value="{{old('Name') ?? $user->Name }}">
        @error('Name')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Phone</label>
        <input type="text" name="Phone" class="form-control" id="phone-input" placeholder="Phone" value="{{old('Phone') ?? $user->Phone }}">
        @error('Phone')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Email</label>
        <input type="email" name="Email" class="form-control" id="email-input" placeholder="Email" value="{{old('Email') ?? $user->Email }}">
        @error('Email')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
    <a href="{{route('manage-users')}}" class="btn btn-warning">Go back</a>
</form>
@endsection