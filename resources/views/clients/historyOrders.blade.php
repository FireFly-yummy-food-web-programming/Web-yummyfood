@extends('layouts.clients')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/clients/home.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection
@section('content')
    <div class="container">
        <h2 style="text-align: center; margin:20px;">Purchase history</h2>
        {{--     
    <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
            chevron_left
        </button>
        <ul class="image-list">
            @foreach ($listDish as $value)
                <li class="card" style="width: 20rem;">
                    <a href="{{ route('users.dish', ['id' => $value->dish_id]) }}"><img
                            src="/storage/images/{{ $value->image_dish }}" class="card-img-top" alt="..."
                            height="600px"></a>
                    <div class="card-body">
                        <div class="name-price">
                            <h5 class="card-title">{{ $value->dish_name }}</h5>
                            <h6 style="color: red">${{ $value->price }}</h6>
                            <h5 id="iconContainer"onclick="toggleIcon(this)" data-icon="{{ $value->dish_id }}">
                                <a
                                    href="{{ session()->get('logged_in') ? route('users.favorites.add', ['id' => $value->dish_id]) : route('users.login') }}">
                                    <i class="icon_favorite fa-solid fa-heart"></i>
                                </a>
                            </h5>
                        </div>
                        <div>
                            <a href="{{ route('users.information-line', ['id' => $value->dish_id]) }}" style="margin-right: 56px; display: inline-block; width: 125px;"
                                class="btn btn-primary">Order details</a>
                            <a href="{{ route('users.dish', ['id' => $value->dish_id]) }}" class="btn btn-danger">Watch live</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
            <button id="next-slide" class="slide-button material-symbols-rounded">
                chevron_right
            </button>
    </div>
    <div class="slider-scrollbar">
        <div class="scrollbar-track">
            <div class="scrollbar-thumb"></div>
        </div>
    </div> --}}
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
                                <h5 style="color: red;">${{ $value->price }}</h5>
                            </div>
                            <div class="">
                                <a href="{{ route('users.information-line', ['id' => $value->dish_id]) }}">Order details</a>
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
