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
    <form class="form-add-dish" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form">
            <div class="mb-3">
                <label for="">Dish name</label>
                <input type="text" name="dish_name" class="form-control input-add-dish" id="" placeholder="Dish name" value="{{old('dish_name')}}">
                @error('dish_name')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="categoris">Choose a category:</label> <br>
                    <select name="category_name" id="category_dame"  class="input-add-dish select-category">
                        @foreach($listCategories as $key => $category)
                        <option  value="{{$category->category_id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="mb-3">
                <label for="photo">Attach a photograph</label>
                <input type="file" name="image_dish" id="image_dish" accept="images/*" class="form-control-file input-add-dish">
                @error('image_dish')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Price</label>
                <input type="text" name="price" class="form-control input-add-dish" id="" placeholder="Price" value="{{old('price')}}">
                @error('price')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Details</label>
                <input type="text" name="detail" class="form-control input-add-dish" id="" placeholder="Detail" value="{{old('detail')}}">
                @error('detail')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>
       <div class="button">
        <button type="submit" class="btn btn-primary">Add new</button>
        <a href="{{route('manage-dish')}}" class="btn btn-warning">Go back</a>
       </div>
    </form>
    @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/clients/formAdddish.css')}}">
@endsection