@extends('layouts.clients')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/clients/home.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection
@section('content')
    <div class="container">
        <h2 style="text-align: center; margin:20px;">Purchase history</h2>
        @foreach ($listDish as $value)
            <div>
                <div>
                    <h6>{{ $value->status }}</h6>
                </div>
                <hr>
                <div class="mb-5">
                    <div class="d-flex justify-content-between row" style="width: 20rem;">
                        <div class="col-md-6" >
                            <a href="{{ route('users.dish', ['id' => $value->dish_id]) }}"><img
                                    src="/storage/images/{{ $value->image_dish }}" class="card-img-top" alt="..." style="margin-top: 0px;"
                                    height="700px">
                            </a>
                        </div>
                        <div class="col-md-6">
                            <div class="name-price">
                                <h5 class="card-title" style=" margin-right:30px">{{ $value->dish_name }}</h5>
                                <p>Price ${{$value->price}}</p>
                            </div>
                            <div class="">
                                <p>X {{$value->quantity}}</p>
                                <p style="color: red;">${{ $value->total_price }}</p>
                                <p>Date: {{$value->order_date}}</p>
                                {{-- <a href="{{ route('users.information-line', ['id' => $value->dish_id]) }}">Order details</a> --}}
                                <a href="{{ route('users.dish', ['id' => $value->dish_id]) }}">Watch live</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/home.js') }}"></script>
@endsection
