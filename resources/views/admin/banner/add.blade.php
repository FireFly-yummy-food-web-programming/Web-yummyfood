@extends('layouts.admin')

@section('content')
<div class="container p-4">
    <form method="post" action="{{ route('add-banner') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="file" class="form-control" name="image">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <textarea class="form-control" placeholder="Description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <select name="status" class="form-control">
                <option value="IsActive">Active</option>
                <option value="InActive">Inactive</option>
            </select>
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Create</button>
            <a href="{{route('manage-banners')}}" class="btn btn-warning">Go back</a>
        </div>
    </form>
</div>
@endsection
