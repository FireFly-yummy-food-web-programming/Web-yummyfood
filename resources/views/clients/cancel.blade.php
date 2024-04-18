@extends('layouts.clients')
   
@section('content')
<div class='row'>
    <h1>Shopping Cart</h1>
    <div class='col-md-12'>
        <div class="card">
            <div class="card-header">
            Cancel
            </div>
            <div class="card-body">
                <a href="{{ url('/') }}" class="btn btn-info"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection