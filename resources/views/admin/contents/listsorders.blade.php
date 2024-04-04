<div class="container">
    <h3>{{$title}}</h3>
<div class="d-flex justify-content-between">
    <div class="">
        <p>Search: <input type="text" name="search" id="dashboar-search-input" class="search-bar" placeholder="Search..." style="font-size:16px;;"></p>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Numerical</th>
            <th>Customer</th>
            <th>Dish name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total price</th>
            <th>Date Order</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Delivery day</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($listOrders))
            @foreach($listOrders as $index => $order)
            <tr colspan = "6">
                <td>{{$index+1}}</td>
                <td>{{$order->Username}}</td>
                <td>{{$order->dish_name}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->total_price}}</td>
                <td>{{$order->order_date}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->payment}}</td>
                <td>
                    <form action="{{route('order.updateStatus') }}" method="POST">
                        <select id="statusSelectorder" name="status" onchange="this.form.submit()" >
                            <option value="{{$order->status}}" id="status">{{$order->status}}</option>
                                @if(($order->status == 'New order'))
                                    <option id="status-shipping-orders" value="Shipping orders">Shipping orders</option>
                                    <option id="status-delivered-orders" value="Delivered orders">Delivered orders</option>
                                    <option id="status-canceled-orders" value="Canceled orders">Canceled orders</option>
                                @endif
                                @if(($order->status == 'Shipping orders'))
                                <option id="status-delivered-orders" value="Delivered orders">Delivered orders</option>
                                <option id="status-canceled-orders" value="Canceled orders">Canceled orders</option>
                                <option id="status-new-order" value="New order">New order</option>
                                @endif
                                @if(($order->status == 'Delivered orders'))
                                <option id="status-shipping-orders" value="Shipping orders">Shipping orders</option>
                                <option id="status-canceled-orders" value="Canceled orders">Canceled orders</option>
                                <option id="status-new-order" value="New order">New order</option>
                                @endif
                                @if(($order->status == 'Canceled orders'))
                                <option id="status-shipping-orders" value="Shipping orders">Shipping orders</option>
                                <option id="status-delivered-orders" value="Delivered orders">Delivered orders</option>
                                <option id="status-new-order" value="New order">New order</option>
                                @endif
                        </select>
                        @csrf
                        <input type="hidden" name="order_id" value="{{$order->order_id}}">
                    </form>
                </td>   
                <td>{{$order->delivery_date}}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
</div>
@section('css')
    <style>
        .container{
            margin-top: 150px
        }

        #statusSelectorder{
            border: 2px solid green;
            outline: none;
            border-radius: 5px;
        }
    </style>
@endsection