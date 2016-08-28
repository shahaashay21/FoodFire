@extends('layout')

@section('title')
FoodFire Dashboard - Online Food Ordering System
@stop

@section('metadesc')
<meta name="description" content="FoodFire Dashboard - Online Food Ordering System" />
@stop

@section('keywords')
<meta name="keywords" content="FoodFire Dashboard - Online Food Ordering System, Anand" />
@stop

@section('content')

<!-- SPACE FOR MOBILE DEVICE -->
<div class="col-xs-12 visible-xs" style="height:45px"></div>

<div class="hidden-xs container-fluid" id="header-bottom-wrap" style="padding-bottom:20px; height:120px">
	<div class="col-lg-2 col-md-2 col-sm-3 hidden-xs">
		<div align="center">
			<div class="img-circle avatar">
				<img id="heading_profile_img" class="img-circle" width="100%" height="100%" alt="Aashay" src="{{ URL::asset('public/images/blank_user.png') }}">
			</div>
		</div>
	</div>
	<div class="col-lg-5 col-md-9 col-sm-9 hidden-xs">
		<div class="bigger" style="font-size:30px; color:#fff; margin-top:30px">Your Dashboard</div>

		<div class="btn-group btn-group-justified" role="group">
			<div class="btn-group" role="group">
				<a href="{{ route('usershome') }}"><button type="button" class="btn filter-effect btn-edit btn-default-edit">My FoodFire</button></a>
			</div>
			<div class="btn-group" role="group">
				<a href="{{ route('usersprofile') }}"><button type="button" class="btn filter-effect btn-edit btn-default-edit">Profile</button></a>
			</div>
			<div class="btn-group" role="group">
				<a href="{{ route('usersorders') }}"><button type="button" class="btn filter-effect btn-edit btn-default-edit">Orders</button></a>
			</div>
			<div class="btn-group" role="group">
				<a href="{{ route('usersreviews') }}"><button type="button" class="btn filter-effect btn-edit btn-default-edit active">Reviews</button></a>
			</div>
		</div>
	</div>
</div>

<div class="visible-xs container-fluid" id="header-bottom-wrap" style="padding-bottom:20px; height:120px">
	<div class="row visible-xs">
		<div class="col-xs-3">
			<div class="img-circle avatar-mob">
				<img id="heading_profile_img" class="img-circle" width="100%" height="100%" alt="Aashay" src="{{ URL::asset('public/images/blank_user.png') }}">
			</div>
		</div>
		<div class="col-xs-9">
			<div align="center">				
				<div class="bigger" style="font-size:28px; color:#fff; margin-top:40px">Your Dashboard</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('javascr')
@stop