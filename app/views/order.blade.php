@extends('layout')

@section('title')
Receipt @ FoodFire
@stop

@section('metadesc')
<meta name="description" content="Receipt FoodFire, Home Delivery, Cash on Delivery, Free Delivery, Thank You For Order" />
@stop

@section('keywords')
<meta name="keywords" content="Receipt FoodFire, Home Delivery, Cash on Delivery, Free Delivery, Thank You For Order" />
@stop

@section('content')
<!-- SPACE FOR MOBILE DEVICE -->
<div class="col-xs-12 visible-xs" style="height:45px"></div>

<div class="container" style="margin-bottom:20px">
	<div class="row">
		<div class="ticket">
			<h1>TOTAL</h1>
			<hr style="margin:0; width:50%">
			<div style="background-color: #000; padding: 30px 0 25px; margin-top:14px">
				<ul class="no-padding">
					<li>Your order ticket</li>
					<li>Total items <span><i class="fa fa-inr"></i> {{ $items }}</span></li>
					<li>Cart subtotal <span><i class="fa fa-inr"></i> {{ $cart }}</span></li>
					<li>Delivery subtotal <span><i class="fa fa-inr"></i> {{ $delivery }}</span></li>
					<li>Total <span><i class="fa fa-inr"></i> {{ $total }}</span></li>
				</ul>

				<span class="button">Order Successfully Sent!</span>
				<p>
					An email has been sent to<br>
					<span>{{ $email }}</span>
				</p>
				<p>
					Your confirmation code:<br>
					<span>{{ $orderid }}</span>
				</p>

				<center><img alt="FoodFire" class="img-responsive" style="margin-bottom:10px" src="{{ URL::asset('public/images/foodfire.png') }}" height="40px" width="150px"></center>
			    <span class="text-muted center-block text-center" style="font-size:0.75em;">THANKS FOR YOUR PURCHASE!</span>
			    <img alt="" src="{{ URL::asset('public/images/serrated.png') }}" width="270" style="position:absolute; margin-top:25px">
			</div>
		</div>
	</div>
</div>
@stop