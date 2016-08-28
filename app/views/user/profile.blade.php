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
				@foreach ($userinfo as $user)
					<img id="heading_profile_img" class="img-circle" width="100%" height="100%" alt="Aashay" src="{{ $user->userimg }}">
				@endforeach
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
				<a href="{{ route('usersprofile') }}"><button type="button" class="btn filter-effect btn-edit btn-default-edit active">Profile</button></a>
			</div>
			<div class="btn-group" role="group">
				<a href="{{ route('usersorders') }}"><button type="button" class="btn filter-effect btn-edit btn-default-edit">Orders</button></a>
			</div>
			<div class="btn-group" role="group">
				<a href="{{ route('usersreviews') }}"><button type="button" class="btn filter-effect btn-edit btn-default-edit">Reviews</button></a>
			</div>
		</div>
	</div>
</div>

<div class="visible-xs container-fluid" id="header-bottom-wrap" style="padding-bottom:20px; height:125px">
	<div class="row visible-xs">
		<div class="col-xs-3">
			<div class="img-circle avatar-mob">
				@foreach ($userinfo as $user)
				<img id="heading_profile_img" class="img-circle" width="100%" height="100%" alt="Aashay" src="{{ $user->userimg }}">
				@endforeach
			</div>
		</div>
		<div class="col-xs-9">
			<div align="center">				
				<div class="bigger" style="font-size:28px; color:#fff; margin-top:40px">Your Dashboard</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<h1 style="font-size:20px; margin-left:10px"><i class="fa fa-user"></i> My Information</h1>
		<hr style="margin-left:0px; margin-top:5px; width:25%; margin-bottom:0px">
		<hr style="margin-right:0px; margin-top:19px; margin-bottom:0px">
	</div>
</div>

<div class="container-fluid" style="background: #edeff0 none repeat scroll 0 0; padding-top:20px">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-1 hidden-xs">
		</div>
		<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<div class="col-xs-12 no-padding panel panel-foodfire">
				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-leaf"></i>
						Information
					</div>
				</div>
				@foreach ($userinfo as $user)
				<div class="panel-body" style="padding-bottom:0px">
					<div class="field">
						<div class="row field-row">
							<div class="col-lg-4 col-md-4 col-sm-5 col-xs-4">
								<div class="col-lg-12 no-padding" style="font-weight:bold; margin-bottom:5px">Profile Picture</div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-7 col-xs-8">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<center>
										<div class="img-circle avatar" style="height:80px; width:80px; margin-top:0px">
											<img class="img-circle" style="margin-bottom:5px;" height="100%" width="100%" alt="Profile" src="{{ $user->userimg }}">
										</div>
									</center>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><center><button class="btn btn-edit btn-warning"><i class="fa fa-upload"></i> Update photo</button></center></div>
							</div>
							
						</div>
						<div class="row field-row">
							<div class="col-lg-4" style="font-weight:bold">Name</div>
							<div class="col-lg-8">
								@if($user->username == null || $user->username == '')
								---
								@else
								{{ ucwords($user->username) }}
								@endif
							</div>
						</div>
						<div class="row field-row">
							<div class="col-lg-4" style="font-weight:bold">Email</div>
							<div class="col-lg-8">
								@if($user->email == null || $user->email == '')
								---
								@else
								{{ $user->email }}
								@endif
							</div>
						</div>
						<div class="row field-row">
							<div class="col-lg-4" style="font-weight:bold">Telephone</div>
							<div class="col-lg-8">
								@if($user->mob == null || $user->mob == '')
								---
								@else
								{{ $user->mob }}
								@endif
							</div>
						</div>
						<div class="row field-row">
							<div class="col-lg-4" style="font-weight:bold">Gender</div>
							<div class="col-lg-8">
								@if($user->gender == null || $user->gender == '')
								---
								@else
								{{ $user->gender }}
								@endif
							</div>
						</div>
						<div class="row field-row">
							<div class="col-lg-4" style="font-weight:bold">Birthday</div>
							<div class="col-lg-8">
								@if($user->birthday == null || $user->birthday == '')
								---
								@else
								{{ $user->birthday }}
								@endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
				<div class="panel-footer">
					<div class="row">
						<div class="col-lg-6">
							<a class="btn btn-edit btn-default-edit pull-left" href="">
								<i class="fa fa-cog fa-white"></i>
								Change Password
							</a>
						</div>
						
						<div class="col-lg-6">
							<a class="btn btn-edit btn-default-edit pull-right" href="">
								<i class="fa fa-edit fa-white"></i>
								Update
							</a>
						</div>
						
					</div>
				</div>
			</div>

			<div class="col-xs-12 no-padding panel panel-foodfire" style="margin-top:20px">
				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-home"></i>
						Address
						<a class="btn btn-edit btn-primary pull-right" style="color:#fff; margin-top:0px" data-toggle="tooltip" data-placement="top" data-title="Enter New Address" onclick="newAddress();" >New Address</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="row addresslist">
						{{ $address }}
					</div>
				</div>
				<div class="panel-footer">
				</div>
			</div>

		</div>
	</div>
</div>

<div class="newaddressbox">
	
</div>

<div class="updateaddressbox">
	
</div>
@stop

@section('javascr')
@stop