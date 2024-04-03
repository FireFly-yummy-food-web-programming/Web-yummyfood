@extends('layouts.admin')
@section('content')
    @include('admin.contents.listsbanners')
@endsection
@section('js')
    <link rel="stylesheet" href="{{asset('assets\js\banner.js') }}">
@endsection