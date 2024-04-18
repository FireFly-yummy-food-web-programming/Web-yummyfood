@extends('layouts.clients')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/clients/orderdetail.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/clients/home.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection
@section('content')
    <div class="container">
        <h2 style="text-align: center; margin:20px;">Information line</h2>
        <div class="d-flex justify-content-between">
            <div class="order-status">
                <h5><i class="fa-regular fa-newspaper"></i><span style="margin-left:25px">Order status</span></h5>
                <p>{{ $listDish->status }}</p>
            </div>
            <div class="order-status">
                <h5><i class="fas fa-map-marker-alt"></i></i><span style="margin-left:25px">Delivery address</span></h5>
                <p>{{ $listDish->Username }}</p>
                <p>{{ $listDish->phone }}</p>
                <p>{{ $listDish->address }}</p>
            </div>
        </div>
        <div>
            <hr>
            <div class="mb-5">
                <div class="d-flex justify-content-between row" style="width: 20rem;">
                    <div class="col-md-6" >
                        <a href="{{ route('users.dish', ['id' => $listDish->dish_id]) }}"><img
                                src="/storage/images/{{ $listDish->image_dish }}" class="card-img-top" alt="..." style="margin-top: 0px;"
                                height="700px">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="name-price">
                            <h5 class="card-title" style=" margin-right:30px">{{ $listDish->dish_name }}</h5>
                            <h5 style="color: red;">${{ $listDish->price }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('users.history-order')}}" class="btn btn-warning">Back</a>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/home.js') }}"></script>
@endsection
