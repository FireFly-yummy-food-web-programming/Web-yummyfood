@extends('layouts.clients')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/clients/shoppingcart.css') }}">
@endsection

@section('content')
<div class="container cart-container">
    <div class="cart-total">
        @php
            $total = 0;
            $i = 1;
            if(session()->has('cart') && count(session('cart')) > 0){
                foreach(session('cart') as $item){
                    $total += $item['quantity'] * $item['price'];
                    $i++;
                }
            }
        @endphp
        
        <form action="{{ route('checkout') }}" method="post" id="form"> 
            @csrf
            <label for="price"><b>Total Price: $</b></label>
            <input style="color:red; border:none; font-weight: bold;" type="number" name="price" id="price" value="{{ $total }}" readonly style="border: none; pointer-events: none;">
            <button id="checkout" class="btn btn-checkout">Checkout</button>
        </form>
    </div>

    @php
        $total = 0;
        $i = 1;
        if(session()->has('cart') && count(session('cart')) > 0){
            foreach(session('cart') as $item){
                $total += $item['quantity'] * $item['price'];
                showcart($item,$i);
                $i++;
            }
        }
    @endphp

    <a href="{{ route('menu') }}">ADD MORE</a>
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
                @foreach($lists as $list)
                <tr>
                    <td>{{ $list['dish_name'] }}</td>
                    <td>{{ $list['quantity'] }}</td>
                    <td>{{ $list['status'] }}</td>
                    <td>${{ $list['total_price'] }}</td>
                    <td>{{ $list['payment'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')

    <script>
        function increaseQuantity(button) {
            var input = button.parentNode.querySelector('input');
            var value = parseInt(input.value, 10);
            input.value = value + 1;
        }

        function decreaseQuantity(button) {
            var input = button.parentNode.querySelector('input');
            var value = parseInt(input.value, 10);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        function removeItem(button) {
            var cartItem = button.closest('.cart-item');
            cartItem.remove();
        }

        let checkout = document.getElementById('checkout');
        checkout.addEventListener('click', (event) => {
            event.preventDefault();

            const price = document.getElementById('price').value;

            if (parseInt(price) > 0) {
                console.log(price);
                const form = document.getElementById('form');
                form.action = 'order';
                form.method = 'post';
                form.submit();
            } else {
                alert('Please choose a product to purchase');
            }
        });
    </script>
@endsection
