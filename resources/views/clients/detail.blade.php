@extends('layouts.clients')
@section('css')
    <link rel="stylesheet" href="{{asset('assets\css\clients\detail.css') }}">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endsection
@section('content')
<div class="container-fluid">
        <div class="main1">
            <div>
                <div class="image_dish">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                      <img src="{{ $dish->image_dish }}" width="100%" id="product-img">
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="especialy">
                            <h2 class="dish_name">{{ $dish->dish_name }}</h2>
                            <div class="star">
                                <span class="star" onclick="toggleStarColor(this)">★</span>
                                <span class="star" onclick="toggleStarColor(this)">★</span>
                                <span class="star" onclick="toggleStarColor(this)">★</span>
                                <span class="star" onclick="toggleStarColor(this)">★</span>
                                <span class="star" onclick="toggleStarColor(this)">★</span>
                            </div>

                            <p class="review">100 reviews</p>
                            <h2 class="price">{{ $dish->price }}</h2>
                            <p class="details">{{ $dish->details }}</p>
                            {{-- <input type="submit" id="add-to-cart" value="Add to cart"> --}}
                            <form action="{{ route('users.add-to-cart', ['id' => $dish->dish_id]) }}" method="POST">
                                @csrf
                                <button type="submit">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment -->
            <div class="cmt">
                <h1><Strong>What Our Customers Say</Strong></h1>
                <div class="container mt-5">
                    <div class="row-cmt">
                        <div class="col-lg-4 col-md-6 col-sm-12" id="idCard">
                            <div class="card-bodyComt">
                                <p class="card-text">
                                    <iconify-icon icon="ri:double-quotes-l"></iconify-icon>
                                    Last night, we dined at place and were simply blown away. From the moment we stepped in, we were enveloped in an inviting atmosphere and greeted with warm smiles. <iconify-icon icon="ri:double-quotes-r"></iconify-icon>
                                </p>

                            </div>
                            <div class="user">
                                <img src="{{asset('assets\images\User1.png')}}" class="rounded-circle" alt="Cinque Terre">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" id="idCard">
                            <div class="card-bodyComt">
                                <p class="card-text">
                                    <iconify-icon icon="ri:double-quotes-l"></iconify-icon>
                                    Place exceeded my expectations on all fronts. The ambiance was cozy and relaxed, making it a perfect venue for our anniversary dinner. Each dish was prepared and beautifully presented. <iconify-icon icon="ri:double-quotes-r"></iconify-icon>
                                </p>
                                
                            </div>
                            <div class="user">
                                <img src="{{asset('assets\images\User2.png')}}" class="rounded-circle" alt="Cinque Terre">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 " id="idCard">
                            <div class="card-bodyComt">
                                <p class="card-text">
                                    <iconify-icon icon="ri:double-quotes-l"></iconify-icon>
                                    The culinary experience at place is first to none. The atmosphere is vibrant, the food - nothing short of extraordinary. The food was the highlight of our evening. Highly recommended. <iconify-icon icon="ri:double-quotes-r"></iconify-icon>
                                </p>
                            </div>
                            <div class="user">
                                <img src="{{asset('assets\images\User3.png')}}" class="rounded-circle" alt="Cinque Terre">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>
@endsection