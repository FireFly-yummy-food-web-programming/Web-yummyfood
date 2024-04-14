@extends('layouts.clients')
@section('css')    
    <link rel="stylesheet" href="{{ asset('assets/css/clients/home.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection
@section('content')
<div class="container">
    <h2 style="text-align: center; margin:20px;">List Favorite</h2>
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
                            <a href="#" style="margin-right: 56px; display: inline-block; width: 125px;"
                                class="btn btn-primary">Detail</a>
                            <a href="#" class="btn btn-danger">Add to cart</a>
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
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/home.js') }}"></script>
@endsection