@extends('layouts.admin')
@section('content')
    {{-- @include('admin.contents.listsdishs') --}}
    @include('admin.contents.listscategories')
@endsection
@section('css')
    <style>
        .container{
            margin-top: 150px
        }
    </style>
@endsection