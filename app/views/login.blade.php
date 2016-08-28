@extends('layout')

@section('title')
Foodfire - Free home delivery
@stop

@section('content')

<!-- SPACE FOR MOBILE DEVICE -->
<div class="col-xs-12 visible-xs" style="height:45px"></div>

<div class="container-fluid search-head">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<i class="fa fa-lock"></i> Account Login
	</div>
	<div class="col-lg-2"></div>
</div>


<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<form class="loginForm" method="post">
				{{ Form::token() }}

				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="panel-title">
							<i class="fa fa-lock"></i>
							Login
						</span>
					</div>
					<div class="panel-body" style="border-top:3px solid #ddd; border-bottom:3px solid #ddd">
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
				        		<a class="forgot-password" style="cursor: pointer" >Forgot Password</a>
				        	</div>
			        	</div>
					</div>
					<div class="panel-footer">
						<div class="row">
				    		<div class="col-xs-12">
				    			<center>
				    				<button type="submit" onclick="return loginSubmit();" style="width:80%; margin-top:10px" class="btn-lg btn-red"><a class="power-icon-login"></a>LOGIN</button>
				    			</center>
							</div>
						</div>
					</div>
				</div>
			        

			</form>
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

});

</script>

@stop