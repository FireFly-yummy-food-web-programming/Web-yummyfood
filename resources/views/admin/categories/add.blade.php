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
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">Category name</label>
            <input type="text" name="category_name" class="form-control" id="" placeholder="Category name" value="{{old('category_name')}}">
            @error('category_name')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add new</button>
        <a href="{{route('manage-categories')}}" class="btn btn-warning">Go back</a>
    </form>
    @endsection