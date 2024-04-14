@extends('layouts.clients')
@section('content')
    <div class="header">
        <h1 class="heading">Best food for your taste</h1>
        <p>Discover delectable cuisine and unforgettable moments in our welcoming, culinary haven.</p>
        <div>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Typing name to search...">
                <button type="submit" class="search-button btn">Search</button>
            </div>

        </div>
        
            
            <div class="button-categories">
                <button class="btn  btn-danger  rounded-pill"><a class="link-btn" href="">all</a></button>
                @foreach ($category as $value)
                    <button class="btn rounded-pill"><a class="link-btn">{{$value->category_name}}</a></button>                    
                @endforeach
            </div> 
            
        
    </div>
    
    <div class="container banner">
        <div class="row">
            <div class="col-md-8">
              <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" >
                    @foreach($bigBanner as $value)
                        <div class="carousel-item active" data-bs-interval="2300">
                            <img src="/storage/banners/{{$value->image}}" class="d-block w-100 _9puaeP OooQQJ  banner-img" alt="...">
                        </div>
                    @endforeach
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <div class="col-md-4">
                <div class="banner-fix">
                        <img width="invalid-value" height="invalid-value" width="100%" alt="Banner"
                        class="_9puaeP OooQQJ" style="object-fit: cover" importance="height;width"
                        src="/storage/banners/banner-sale.png">
                </div>
                <div class="banner-fix" style="padding-top:10px ">
                        <img width="invalid-value" height="invalid-value"
                        alt="Banner" class="_9puaeP OooQQJ" style="object-fit: cover"
                        src="/storage/banners/banner-saler.png">
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <h2 style="text-align: center; margin:20px;">Recommended products</h2>
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
                                        @if (in_array($value->dish_id, $listDishId))
                                            <i class="icon_favorite fa-solid fa-heart"></i>
                                        @else
                                            <i class="icon_favorite fa-regular fa-heart"></i>
                                        @endif
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


    <div class="container">
        <h2 style="text-align: center; margin:20px;">Promotional products</h2>
        <div class="slider-wrapper">
            <button id="prev-slide" class="slide-button material-symbols-rounded">
                chevron_left
            </button>
            <ul class="image-list">
                @foreach ($listRandom as $value)
                    <li class="card" style="width: 20rem;">
                        <a href="#"><img src="/storage/images/{{ $value->image_dish }}" class="card-img-top"
                                alt="..." height="600px"></a>
                        <div class="card-body">
                            <div class="name-price">
                                <h5 class="card-title">{{ $value->dish_name }}</h5>
                                <h6 style="color: red">${{ $value->price }}</h6>

                                <h5 id="iconContainer" onclick="toggleIcon(this)" data-icon="{{ $value->dish_id }}">
                                    <i id="icon" class="fa-regular fa-heart"></i>
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


    <div class="container">
        <h2 style="text-align: center; margin:20px;">All products</h2>
        <div class="slider-wrapper">
            <button id="prev-slide" class="slide-button material-symbols-rounded">
                chevron_left
            </button>
            <ul class="image-list">
                @foreach ($listRandomPromotion as $value)
                    <li class="card" style="width: 20rem;">
                        <a href="{{ route('users.dish', ['id' => $value->dish_id]) }}"><img
                                src="/storage/images/{{ $value->image_dish }}" class="card-img-top" alt="..."
                                height="600px"></a>
                        <div class="card-body">
                            <div class="name-price">
                                <h5 class="card-title">{{ $value->dish_name }}</h5>
                                <h6 style="color: red"><del>${{ $value->price }}</del>
                                    ${{ number_format($value->price * (1 - $value->discount / 100), 2) }}</h6>
                                    <h5 id="iconContainer"onclick="toggleIcon(this)" data-icon="{{ $value->dish_id }}">
                                        <a
                                        href="{{ session()->get('logged_in') ? route('users.favorites.add', ['id' => $value->dish_id]) : route('users.login') }}">
                                        @if (in_array($value->dish_id, $listDishId))
                                            <i class="icon_favorite fa-solid fa-heart"></i>
                                        @else
                                            <i class="icon_favorite fa-regular fa-heart"></i>
                                        @endif
                                    </a>
                                    </h5>
                                @if ($value->discount > 1)
                                    <h1 class="corner-badge">{{ $value->discount }}%</h1>
                                @endif
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
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/clients/home.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection
@section('js')
    <script src="{{ asset('assets/js/home.js') }}"></script>
@endsection
