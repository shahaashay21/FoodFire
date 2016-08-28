@extends('layout')

@section('title')
Checkout @ FoodFire
@stop

@section('metadesc')
<meta name="description" content="Checkout FoodFire, Home Delivery, Cash on Delivery, Free Delivery" />
@stop

@section('keywords')
<meta name="keywords" content="Checkout FoodFire, Home Delivery, Cash on Delivery, Free Delivery" />
@stop

@section('content')

<!-- SPACE FOR MOBILE DEVICE -->
<div class="col-xs-12 visible-xs" style="height:45px"></div>

<div class="container-fluid ff-head">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<i class="fa fa-shopping-cart"></i> Checkout
	</div>
	<div class="col-lg-2"></div>
</div>

<div class="newaddressbox">
	
</div>

<div class="container">
	<div class="row">
		@if(Auth::check())
		<div class="col-lg-offset-1 col-lg-3 col-md-4 col-sm-5 col-xs-12">
			<div class="row">
				<div class="col-xs-12 no-padding panel panel-foodfire">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="fa fa-rocket"></i>
							Delivery Information
						</div>
					</div>
					<div class="panel-body" style="max-height:190px; overflow:auto">
						{{ $addresss }}
						<!-- <div class="row" style="margin-bottom:10px">
							<div class="col-xs-1">
								<input type="radio" value="" name="address" checked>
							</div>
							<div class="col-xs-9">
								<div class="row no-padding">
									<div class="col-xs-12">
										<b>Aashay</b>
									</div>
									<div class="col-xs-12">
										204, Tirth Complex, Nana Bazar, Vallabh vidyanagar
									</div>
									<div class="col-xs-12">
										Nana Bazar
									</div>
									<div class="col-xs-12">
										Anand, Gujarat, India
									</div>
								</div>
							</div>
						</div>

						<div class="row" style="margin-bottom:10px">
							<div class="col-xs-1">
								<input type="radio" value="" name="address">
							</div>
							<div class="col-xs-9">
								<div class="row no-padding">
									<div class="col-xs-12">
										<b>Aashay</b>
									</div>
									<div class="col-xs-12">
										204, Tirth Complex, Nana Bazar, Vallabh vidyanagar
									</div>
									<div class="col-xs-12">
										Nana Bazar
									</div>
									<div class="col-xs-12">
										Anand, Gujarat, India
									</div>
								</div>
							</div>
						</div>
						<a class="btn btn-primary" onclick="newAddress();" >New Address</a> -->
					</div>
					<div class="panel-footer">
						<a class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-title="Enter New Address" onclick="newAddress();" >New Address</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 no-padding panel panel-foodfire">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="fa fa-money"></i>
							Payment Option
						</div>
					</div>
					<div class="panel-body" style="padding:15px 35px">
						<div class="row ff-menu-product">
							<div class="col-xs-1">
								<input type="radio" name="payment" value="1" checked>
							</div>
							<div class="col-xs-10">
								Cash On Delivery
							</div>	
						</div>

						<div class="row ff-menu-product">
							<div class="col-xs-1">
								<fieldset disabled>
									<input type="radio" name="payment" value="2">
								</fieldset>
							</div>
							<div class="col-xs-10" style="font-size:12px; color:#777">
								Credit/Debit Card (Coming soon)
							</div>	
						</div>

						<div class="row ff-menu-product">
							<div class="col-xs-1">
								<fieldset disabled>
									<input type="radio" name="payment" value="3">
								</fieldset>
							</div>
							<div class="col-xs-10" style="font-size:12px; color:#777">
								Paypal (Coming soon)
							</div>	
						</div>
						
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-offset-1 col-lg-3 col-md-4 col-sm-5 col-xs-12">
			<form class="loginForm1" method="post">
				{{ Form::token() }}

				<div class="panel panel-foodfire">
					<div class="panel-heading">
						<span class="panel-title">
							<i class="fa fa-lock"></i>
							Login
						</span>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
								<center><div class="regAjaxLoading"><i class="fa fa-spinner fa-pulse fa-lg" style="margin-right: 8px"></i>Processing...</div></center>
							</div>
							<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
								<center><div style="color: #db2e2e; font-weight: bold; display:none" class="wrong-cred">Wrong Email or Password</div></center>
							</div>
							<div class="col-xs-12">
				        		<input type="email" id="email-login1" name="email" placeholder="* Email id" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
				        		<span class="glyphicon glyphicon-remove inp-syb email-login1-glyphicon" aria-hidden="true" style="display:none"></span>
				        	</div>
				        	<div class="col-xs-12">
				        		<input type="password" id="pass-login1" name="password" placeholder="* Password" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
				        		<span class="glyphicon glyphicon-remove inp-syb pass-login1-glyphicon" aria-hidden="true" style="display:none"></span>
				        		<!-- <span class="min6char" style="color:#db2e2e; display:none; font-size:10px; font-weight: bold;">Password must be more than 5 characters!</span> -->
				        	</div>
				        	<div class="col-xs-12" style="font-size: 16px; text-align:right; margin-bottom:10px">
				        		<a class="forgot-password" style="cursor: pointer">Forgot Password</a>
				        	</div>
			        	</div>
					</div>
					<div class="panel-footer">
						<div class="row">
				    		<div class="col-xs-6">
				    			<center>
				    				<button type="submit" onclick="return loginSubmit();" style="font-size:14px; margin-top:10px; font-weight:900; width:100%" class="btn btn-success">LOGIN</button>
				    			</center>
							</div>
							<div class="col-xs-6">
								<span style="font-size:14px; margin-top:10px; font-weight:900;" class="btn btn-danger register-click" data-target=".register-modal" data-toggle="modal">REGISTER</span>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

		@endif
		<div id="product-cart" class="col-lg-7 col-md-8 col-sm-7 col-xs-12" style="margin-top: -20px;">
			<div id="wrap-sticky" style="padding-top:5px">
				
			</div>
		</div>
	</div>
</div>


@stop

@section('javascr')

<script type="text/javascript">
	
$(document).ready(function(e){

	$('body').css('background','#fafafa');

	$('#email-login1').on('keyup click focus blur change', function(){
		nullFieldValidation('email-login1');
	});
	$('#pass-login1').on('keyup click focus blur change', function(){
		nullFieldValidation('pass-login1');
	});



	// LOGIN FORM QUERY
	$(".loginForm1").submit(function(e){
		e.preventDefault();

		var data = $('.loginForm1').serializeArray();

		$.ajax({
			type: "POST",
			url: "/login",
			dataType: "json",
			data: data,
			cache: false,
			beforeSend:function(){
				$('.regAjaxLoading').show();
				$(".wrong-cred").hide();
			},
			success:function(response){
				$('.regAjaxLoading').hide();
				if(response == "not verify"){
					$(".login-modal").modal('hide');
					alertline('alert-notify-warning','You have not verified your Email. <b>Please verify</b>');
				}
				else if(response == "Fail"){
					$(".wrong-cred").show();
				}
				else{
						// location.reload();
						window.location="/checkout";
				}
			}
		});
	});



	//FINAL ORDER AJAX
	// LOGIN FORM QUERY
	$(".confirm-order").click(function(e){
		// e.preventDefault();
		alert('sa');
		var data = $('.loginForm1').serializeArray();

		alert($("input [name=address]").value());
		return;

		$.ajax({
			type: "POST",
			url: "/order",
			dataType: "json",
			data: data,
			cache: false,
			beforeSend:function(){
				$('.regAjaxLoading').show();
				$(".wrong-cred").hide();
			},
			success:function(response){
				$('.regAjaxLoading').hide();
				if(response == "not verify"){
					$(".login-modal").modal('hide');
					alertline('alert-notify-warning','You have not verified your Email. <b>Please verify</b>');
				}
				else if(response == "Fail"){
					$(".wrong-cred").show();
				}
				else{
						// location.reload();
						window.location="/checkout";
				}
			}
		});
	});

});

</script>

@stop