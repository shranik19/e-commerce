@extends('layout')
@section('content')
    <div class="container">
        <div class="alert alert-success">
            Your order has been placed successfully. Your order ID is {{session('orderId')}}.
        </div>
    </div>
@endsection