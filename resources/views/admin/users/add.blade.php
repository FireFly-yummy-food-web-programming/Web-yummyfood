@extends('layouts.admin')
@section('content')
@if(session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">Input data is invalid. Please check again</div>
@endif
<h3>{{$title}}</h3>
<hr >
<form action="{{ route('post-add-users') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="">Username</label>
        <input type="text" name="Username" class="form-control" id="" placeholder="Username" value="{{old('Username')}}">
        @error('Username')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Password</label>
        <input type="password" name="Password" class="form-control" id="" placeholder="Password">
        @error('Password')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Name</label>
        <input type="text" name="Name" class="form-control" id="" placeholder="Name" value="{{old('Name')}}">
        @error('Name')
            <span style="color: red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Phone</label>
        <input type="text" name="Phone" class="form-control" id="" placeholder="Phone" value="{{old('Phone')}}">
    </div>
    <div class="mb-3">
        <label for="">Email</label>
        <input type="email" name="Email" class="form-control" id="" placeholder="Email" value="{{old('Email')}}">
    </div>
    <button type="submit" class="btn btn-primary">Add new</button>
    <a href="{{route('manage-users')}}" class="btn btn-warning">Go back</a>
</form>
@endsection