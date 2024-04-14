@extends('layouts.clients')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/clients/cart.css') }}">
@endsection

@section('content')
<div class="container cart-container">
    <div class="shopping-cart">

      @if($cartItems->count() > 0)
      <div class="column-labels">
          <label class="product-image">Image</label>
          <label class="product-details">Product</label>
          <label class="product-price">Price</label>
          <label class="product-quantity">Quantity</label>
          <label class="product-line-price">Total</label>
          <label class="product-removal">Remove</label>
      </div>
      @foreach($cartItems as $cartItem)
    <div class="product">
        @if ($cartItem->dish) <!-- Kiểm tra xem 'dish' có tồn tại không -->
            <div class="product-image">
                <img src="{{ $cartItem->dish->image_dish }}">
            </div>
            <div class="product-details">
                <div class="product-title">{{ $cartItem->dish->dish_name }}</div>
                <p class="product-description">{{ $cartItem->dish->details }}</p>
                <div class="product-price">{{ $cartItem->dish->price }}</div>
            </div>
        @endif
        <div class="product-quantity">
            <input type="number" value="{{ $cartItem->quantity }}" min="1">
        </div>
        <div class="product-line-price">
            @if ($cartItem->dish)
                ${{ $cartItem->dish->price * $cartItem->quantity }}
            @endif
        </div>
        <div class="product-removal">
            <button class="remove-product" onclick="removeFromCart({{ $cartItem->dish_id }})">
                Remove
            </button>
        </div>
    </div>
@endforeach
      @endif
        <div class="totals">
          <div class="totals-item">
            <label>Subtotal</label>
            <div class="totals-value" id="cart-subtotal">71.97</div>
          </div>
          <div class="totals-item">
            <label>Tax (5%)</label>
            <div class="totals-value" id="cart-tax">3.60</div>
          </div>
          <div class="totals-item">
            <label>Shipping</label>
            <div class="totals-value" id="cart-shipping">15.00</div>
          </div>
          <div class="totals-item totals-item-total">
            <label>Grand Total</label>
            <div class="totals-value" id="cart-total">90.57</div>
          </div>
        </div>
            
            <button class="checkout">Checkout</button>
      
      </div>

    {{-- <a href="#">ADD MORE</a> --}}
    {{-- <a href="{{ route('menu') }}">ADD MORE</a> --}}
</div>
</div>

<div class="container bg-white p-5" id="renderOrder">
    <h3>Your order</h3>
    <div class="container-fluid">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Dish name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Payment method</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($dishs))
                    @foreach($dishs as $dish)
                    <tr>
                        <td>{{ $dish->dish_name }}</td>
                        <td>{{ $dish->quantity }}</td>
                        <td>{{ $dish->status }}</td>
                        <td>{{ $dish->total_price }}</td>
                        <td>{{ $dish->payment }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script src="{{asset('assets/js/cart.js')}}"></script>
@endsection
