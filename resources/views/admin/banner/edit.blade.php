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
    <form class="form-add-banner" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form">
            <div class="mb-3">
                <label for="">Banner name</label>
                <input type="text" name="name" class="form-control input-add-banner" id="" placeholder="Banner name" value="{{old('name')?? $banner->name}}">
                @error('dish_name')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="photo">Attach a photograph</label>
                <input type="file" name="image" id="image" accept="images/*" class="form-control-file input-add-banner">
                @error('image')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Description</label>
                <input type="text" name="description" class="form-control input-add-banner" id="" placeholder="Description" value="{{old('description')?? $banner->description}}">
                @error('description')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Status</label>
                <select name="status" class="form-control">
                    <option value="IsActive">Active</option>
                    <option value="InActive">Inactive</option>
                </select>
                @error('status')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="button">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('manage-banners')}}" class="btn btn-warning">Go back</a>
           </div>
    </form>
@endsection
