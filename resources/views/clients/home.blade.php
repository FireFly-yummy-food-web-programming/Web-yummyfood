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

    <div class="button-categories d-flex gap-4">
        <button class="btn  btn-danger  rounded-pill" ><a class="link-btn" href="">all</a></button>
        <button class="btn   rounded-pill"><a class="link-btn" href="">Snacks</a></button>
        <button class="btn   rounded-pill"><a class="link-btn">Vegetarianfood</a></button>
        <button class="btn   rounded-pill"><a class="link-btn">Rice</a></button>
        <button class="btn   rounded-pill"><a class="link-btn">Noodle</a></button>
        {{-- <button class="btn   rounded-pill"><a class="link-btn">Drinks</a></button>
        <button class="btn   rounded-pill"><a class="link-btn">Milk tea</a></button> --}}
    </div>
   {{-- @yield('content') --}}
</div>
{{-- @foreach ($listDish as $value)
        {{-- # code... --}}
    {{-- <h4 class="" >{{$value->dish_name}}</h4>     --}}
    {{-- @endforeach --}} 
<div class="banner">    
  <div class="bgImage">
      <div class="overlay"></div>

      <div class="content-banner">
          <h1>Big <span>Sale</span></h1>
          <p class="banner-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. 
              Amet, commodi? Molestiae laborum perferendis deleniti assumenda modi, 
              sit quas maiores, sint molestias voluptatum repudiandae aspernatur nemo, 
              velit ullam delectus id architecto!
              Explicabo quibusdam ullam voluptas voluptate corporis cupiditate libero 
              rem ad quod consequatur dolorum alias porro eos doloribus quisquam a, 
              pariatur autem rerum, amet atque non adipisci facere. Perferendis, 
              iure officia.
          </p>
          <p class="banner-buynow">
              Buy now
          </p>
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
    @foreach($listDish as $value)
    <li class="card" style="width: 20rem;">
        <a href="{{route('users.dish',['id'=>$value->dish_id])}}"><img src="/storage/images/{{$value->image_dish}}" class="card-img-top" alt="..." height="600px"></a>
        <div class="card-body">
            <div class="name-price">
              <h5 class="card-title">{{$value->dish_name}}</h5>
              <h6 style="color: red">${{$value->price}}</h6>

              <h5 id="iconContainer" onclick="toggleIcon(this)" data-icon="{{$value->dish_id}}">
                  <i id="icon" class="fa-regular fa-heart"></i>
              </h5>

            </div>
            <div>
              <a href="#" style="margin-right: 56px; display: inline-block; width: 125px;" class="btn btn-primary">Detail</a> 
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
  <h2 style="text-align: center; margin:20px;">Promotional products</h2>
  <div class="slider-wrapper">
    <button id="prev-slide" class="slide-button material-symbols-rounded">
      chevron_left
    </button>
    <ul class="image-list">
      @foreach($listRandomPromotion as $value)
      <li class="card" style="width: 20rem;">
          <a href="{{route('users.dish',['id'=>$value->dish_id])}}"><img src="/storage/images/{{$value->image_dish}}" class="card-img-top" alt="..." height="600px"></a>
          <div class="card-body">
              <div class="name-price">
                  <h5 class="card-title">{{$value->dish_name}}</h5>
                  <h6 style="color: red"><del>${{$value->price}}</del> ${{number_format($value->price * (1 - $value->discount/100), 2)}}</h6>
  
                  <h5 id="iconContainer" onclick="toggleIcon(this)" data-icon="{{$value->dish_id}}">
                      <i id="icon" class="fa-regular fa-heart"></i>
                  </h5>
                  @if ($value->discount > 1)
                      <h1 class="corner-badge">{{$value->discount}}%</h1>
                  @endif
              </div>
              <div>
                  <a href="#" style="margin-right: 56px; display: inline-block; width: 125px;" class="btn btn-primary">Detail</a>
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
<h2 style="text-align: center; margin:20px;">All products</h2>
<div class="slider-wrapper">
<button id="prev-slide" class="slide-button material-symbols-rounded">
chevron_left
</button>
<ul class="image-list">
    @foreach($allDish as $value)
    <li class="card" style="width: 20rem;">
        <a href="{{route('users.dish',['id'=>$value->dish_id])}}"><img src="/storage/images/{{$value->image_dish}}" class="card-img-top" alt="..." height="600px"></a>
        <div class="card-body">
            <div class="name-price">
              <h5 class="card-title">{{$value->dish_name}}</h5>
              <h6 style="color: red">${{$value->price}}</h6>

              <h5 id="iconContainer" onclick="toggleIcon(this)" data-icon="{{$value->dish_id}}">
                  <i id="icon" class="fa-regular fa-heart"></i>
              </h5>

            </div>
            <div>
              <a href="#" style="margin-right: 56px; display: inline-block; width: 125px;" class="btn btn-primary">Detail</a> 
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

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/clients/home.css')}}">    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection
@section('js')
<script src="{{asset('assets/js/home.js')}}"></script>  
@endsection