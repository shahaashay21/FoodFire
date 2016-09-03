@if(Session::has('conf'))
	<div class="alert-top-notify col-lg-12 confirm-alert"></div>
@else
	<div class="alert-top-notify suc col-lg-12"></div>
@endif


<div class="left_slide hidden-sm hidden-md hidden-lg" style="z-index:995;">
	<div class="head_foodfire" style="height:45px;">
    	<a style="text-decoration:none; float:left"><div class="header_left-slide_text" style="color:#666666; font-size:22px; margin-top:6px;">FoodFire</div></a>
        <a class="header_left-slide_close"></a>
        <!-- <button class="close header_left-slide_close hidden-sm hidden-md- hidden-lg" aria-label="Close"><span aria-hidden="true" style="color:white">&times;</span></button> -->
    </div>
    <div class="head_foodfire" style="padding-top:7px">{{ HTML::linkRoute('index', 'Home', array(), array('class' => 'header_left-slide_text', 'style' => 'text-decoration:none')) }}
    </div>
    <div class="head_foodfire"><a href="" style="text-decoration:none"><div class="header_left-slide_text">About FoodFire</div></a>
    </div>
    <div class="head_foodfire"><a href="" style="text-decoration:none"><div class="header_left-slide_text">How FoodFire Works</div></a>
    </div>
    <div class="head_foodfire"><a href="" style="text-decoration:none"><div class="header_left-slide_text">Why Choose FoodFire</div></a>
    </div>
    <div class="head_foodfire"><a href="" style="text-decoration:none"><div class="header_left-slide_text">Contact Us</div></a>
    </div>
    <div class="head_foodfire"><a href="" style="text-decoration:none"><div class="header_left-slide_text">Any Suggestion?</div></a>
    </div>
    <div style="margin-top: 20px; background: #4dd347; height: 35px; padding-top:6px">
    	<center>
    	<a style="color: #fff; text-decoration: underline; font-weight:bold" href="whatsapp://send?text=Hey, checkout this amazing service, I am using it for my food delivery. Foodfire - Food at your doorstep, visit http://foodfire.in or call: 919712318526" data-action="share/whatsapp/share">Share via Whatsapp</a>
    	</center>
    </div>
    <center><div style="margin-top: 15px">
    	<a class="btn btn-sm btn-social-icon btn-twitter" style="margin-left: 15px;"><i class="fa fa-twitter"></i></a>
    	<a class="btn btn-sm btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
    	<a href="https://www.google.com/+FoodfireIn" class="btn btn-sm btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
    </div></center>
    <div style="margin-top: 10px; color:#666666;">
	    <center>Foodfire @ 2015</center>
	    <center>Developed By</center>
	    <center style="color:#428bca;">Aashay Shah</center>
    </div>
</div><!-- left-slide -->

<!-- START LOGIN MODAL -->
<div class="modal fade login-modal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="loginForm" method="post">
    		{{ Form::token() }}
	    	<div class="modal-header" style="padding-bottom:5px">
	    		<a class="close-login-modal" data-dismiss="modal"></a>
	    		<!-- <button type="button" class="close hidden-sm hidden-md- hidden-lg" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
		        <center><span class="modal-title"><img alt="FoodFire" src="{{ URL::asset('public/images/FoodSymbol.png') }}"></span></center>
		    </div>
	    	<div class="modal-body" style="background: #f4f7f8">
	    		<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
					<center><div class="regAjaxLoading"><i class="fa fa-spinner fa-pulse fa-lg" style="margin-right: 8px"></i>Processing...</div></center>
				</div>
				<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
					<center><div style="color: #db2e2e; font-weight: bold; display:none" class="wrong-cred">Wrong Email or Password</div></center>
				</div>
		    	<table border="0" style="margin-right:15px;">
		    		<tr>
		    			<td>
		    				<div class="row">
		    					<div class="hidden-xs col-sm-12" style="margin-right:40px">
		    						<span class="login-lock-icon"></span>
		    					</div>
		    				</div>
		    			</td>
		    			<td>
		    				<div class="row">
		    					<!-- Log In with facebook OR twitter -->
		    					<div class="hidden-xs col-sm-6">
									<center><a class="btn btn-social btn-facebook" style="margin-bottom:10px;"><i class="fa fa-facebook"></i> Login with Facebook</a></center>
		    					</div>
		    					<div class="hidden-xs col-sm-6">
		    						<center><a class="btn btn-social btn-twitter" style="margin-bottom:20px;"><i class="fa fa-twitter"></i> Login with Twitter</a></center>
		    					</div>
					        	<div class="col-xs-12">
					        		<input type="email" id="email-login" name="email" placeholder="* Email id" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
					        		<span class="glyphicon glyphicon-remove inp-syb email-login-glyphicon" aria-hidden="true" style="display:none"></span>
					        	</div>
					        	<div class="col-xs-12">
					        		<input type="password" id="pass-login" name="password" placeholder="* Password" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
					        		<span class="glyphicon glyphicon-remove inp-syb pass-login-glyphicon" aria-hidden="true" style="display:none"></span>
					        		<!-- <span class="min6char" style="color:#db2e2e; display:none; font-size:10px; font-weight: bold;">Password must be more than 5 characters!</span> -->
					        	</div>
					        	<div class="col-xs-12" style="font-size: 16px; text-align:right; margin-bottom:10px">
					        		<a class="forgot-password" style="cursor: pointer" >Forgot Password</a>
					        	</div>
					        </div>
		        		</td>
		    		</tr>
		    	</table>
	    	</div> 
	    	<div class="modal-footer" style="padding-top:0px;">
	    		<div class="row">
		    		<div class="col-xs-12">
		    			<center>
		    				<button type="submit" onclick="return loginSubmit();" style="width:80%; margin-top:10px" class="btn-lg btn-red"><a class="power-icon-login"></a>LOGIN</button>
		    			</center>
					</div>
				</div>
    		</div>
    	</form>
    </div>
  </div>
</div>
<!-- END LOGIN MODAL -->

<!-- START REGISTER MODAL -->
<div class="modal fade register-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header" style="padding-bottom:5px">
	    		<a class="close-login-modal" data-dismiss="modal"></a>
	    		<!-- <button type="button" class="close hidden-sm hidden-md- hidden-lg" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
		        <center><span class="modal-title"><img alt="FoodFire" src="{{ URL::asset('public/images/FoodSymbol.png') }}"></span></center>
		    </div>
		    <form class="regForm" method="post">
			    <div class="modal-body" style="background: #f4f7f8;">
					<div class="row">
						<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
							<center><div class="regAjaxLoading"><i class="fa fa-spinner fa-pulse fa-lg" style="margin-right: 8px"></i>Processing...</div></center>
						</div>

						<!-- FACEBOOK AND GOOGLE REGISTER API BUTTONS -->
						<div class="col-sm-5 hidden-xs" id="register">
							<div class="hidden-xs col-sm-12">
								<div id="fb-root"></div>
								<center><a class="btn btn-social btn-facebook" onclick="facebookLogin();" style="margin-bottom:20px; margin-top: 40px"><i class="fa fa-facebook"></i> Register with Facebook</a></center>
								
							</div>
							<div class="hidden-xs col-sm-12" style="margin-bottom:20px;">
								<center>OR</center>
							</div>
							<div class="hidden-xs col-sm-12">
								<center><a id="authorize-button" onclick="handleClientLoad();" class="btn btn-social btn-google-plus" style="margin-bottom:20px;"><i class="fa fa-google-plus"></i> Register with Google</a></center>
							</div>
							<!-- FOR MOBILE DEVICES -->
							<div class="col-xs-6 hidden-sm hidden-md hidden-lg">
								<center><a class="btn btn-social btn-facebook" onclick="facebookLogin();" style="margin-bottom:20px;"><i class="fa fa-facebook"></i> SignUp</a></center>
							</div>
							<div class="col-xs-6 hidden-sm hidden-md hidden-lg">
								<center><a id="authorize-button" class="btn btn-social btn-google-plus" style="margin-bottom:20px;"><i class="fa fa-google-plus"></i> SignUp</a></center>
							</div>
							<!-- END FOR MOBILE DEVICES -->
						</div>
						<div class="col-sm-5 profile">
							<div class="hidden-xs col-sm-12">
								<img id="profile-picture" alt="Profile Photo" >
							</div>
						</div>
						<!-- END FACEBOOK AND GOOGLE REGISTER API BUTTONS -->
						{{ Form::token() }}
						<!-- REMOVE FB AND GOOGLE BUTTON AND ADD LOCK IMAGE -->
						<!-- <div class="col-sm-7"> -->
						<!-- <div class="hidden-xs col-sm-3" style="margin-top:30px">
		    					<span class="login-lock-icon"></span>
		    			</div> -->
		    			<!-- END REMOVE FB AND GOOGLE BUTTON AND ADD LOCK IMAGE -->
						<div class="col-sm-7">
							<div class="col-xs-12">
			    				<input type="text" id="name" name="name" class="inputfield" placeholder="Name..." style="margin-bottom:20px; height:40px; font-size:18px">
			    				<span class="glyphicon glyphicon-ok inp-syb name-glyphicon" aria-hidden="true" style="display:none"></span>
				    		</div>
				    		<div class="col-xs-12">
				    			<input type="text" id="mobile" name="mobile" class="inputfield" placeholder="Mobile..." style="margin-bottom:20px; height:40px; font-size:18px">
				    			<span class="glyphicon glyphicon-remove inp-syb mobile-glyphicon" aria-hidden="true" style="display:none"></span>
				    			<span class="mobmin6char" style="color:#db2e2e; display:none; font-size:10px; font-weight: bold;">Mobile must be more than 5 characters and numeric!</span>
				    		</div>
				    		<div class="col-xs-12">
				    			<input type="email" id="email" name="email" class="inputfield" placeholder="Email..." style="margin-bottom:0px; height:40px; font-size:18px">
				    			<span class="glyphicon glyphicon-remove inp-syb email-glyphicon" aria-hidden="true" style="display:none"></span>
				    			<span class="emailregistered" style="color:#db2e2e; visibility:hidden; font-size:10px; font-weight: bold;">Email has already been registered!</span>
				    		</div>
				    		<div class="col-xs-12">
				    			<input type="password" name="password" class="inputfield" id="pass" placeholder="Password..." style="height:40px; font-size:18px; margin-bottom: 20px">
				    			<span class="glyphicon glyphicon-remove inp-syb pass-glyphicon" aria-hidden="true" style="display:none"></span>
				    			<span class="min6char" style="color:#db2e2e; display:none; font-size:10px; font-weight: bold;">Password must be more than 5 characters!</span>
				    		</div>
						</div>
			    		
			    	</div>	
			    </div>
			    <div class="modal-footer" style="padding-top:0px;">
			    	<div class="row">
			    		<div class="col-xs-12">
			    			<center>
			    				<button type="submit" onclick="return registerSubmit();" style="width:80%; margin-top:10px; font-weight:900" class="btn btn-lg btn-success client_register"><a class="lock-icon-register"></a>REGISTER NOW</button>
			    			</center>
						</div>
					</div>
			    </div>
		    </form>
		</div>
	</div>
</div>
<!-- END REGISTER MODAL -->


<!-- START PASSWORD RESET MODAL  --- AASHAY SHAH 9 JUN 2015 --- -->
<div class="modal fade reset-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="resetForm" method="post">
    		{{ Form::token() }}
	    	<div class="modal-header" style="padding-bottom:5px">
	    		<a class="close-login-modal" data-dismiss="modal"></a>
	    		<!-- <button type="button" class="close hidden-sm hidden-md- hidden-lg" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
		        <center><span class="modal-title"><img alt="FoodFire" src="{{ URL::asset('public/images/FoodSymbol.png') }}"></span></center>
		    </div>
	    	<div class="modal-body" style="background: #f4f7f8">
	    		<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
					<center><div class="regAjaxLoading"><i class="fa fa-spinner fa-pulse fa-lg" style="margin-right: 8px"></i>Processing...</div></center>
				</div>
		    	<table border="0" style="margin-right:15px; width:100%">
		    		<tr>
		    			<td class="hidden-xs" style="width: 30%">
		    				<div class="row">
		    					<div class="hidden-xs col-sm-12">
		    						<span class="login-lock-icon"></span>
		    					</div>
		    				</div>
		    			</td>
		    			<td>
		    				<div class="row">
		    					<!-- Log In with facebook OR twitter -->
		    					<input type="hidden" name="type" value="cus">
					        	<div class="col-xs-12">
					        		<input type="email" id="email-reset" name="email" placeholder="* Email id" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
					        		<span class="glyphicon glyphicon-remove inp-syb email-reset-glyphicon" aria-hidden="true" style="display:none"></span>
					        	</div>
					        	<!-- <div style="font-size: 16px; text-align:right; margin-bottom:10px; display:none">
					        		<a class="forgot-password" style="cursor: pointer" >Forgot Password</a>
					        	</div> -->
					        </div>
		        		</td>
		    		</tr>
		    	</table>
		        

	    	</div> 
	    	<div class="modal-footer" style="padding-top:0px;">
	    		<div class="row">
		    		<div class="col-xs-12">
		    			<center>
		    				<button type="submit" onclick="return resetSubmit();" style="width:80%; margin-top:10px" class="btn-lg btn-red submit-reset"><a class="power-icon-login"></a>RESET</button>
		    			</center>
					</div>
				</div>
    		</div>
    	</form>
    </div>
  </div>
</div>
<!-- END PASSWORD RESET MODAL -->


@if(Session::has('reset-form'))
<!-- PASSWORD RESET FORM -->
<div class="modal fade reset-form-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="reset-form-Form" method="post">
    	{{ Form::token() }}
	    	<div class="modal-header" style="padding-bottom:5px">
	    		<a class="close-login-modal" data-dismiss="modal"></a>
	    		<!-- <button type="button" class="close hidden-sm hidden-md- hidden-lg" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
		        <center><span class="modal-title"><img alt="FoodFire" src="{{ URL::asset('public/images/FoodSymbol.png') }}"></span></center>
		    </div>
	    	<div class="modal-body" style="background: #f4f7f8">
	    		<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
					<center><div class="regAjaxLoading"><i class="fa fa-spinner fa-pulse fa-lg" style="margin-right: 8px"></i>Processing...</div></center>
				</div>
				<div class="col-xs-12" style="margin-top:-5px; margin-bottom:9px">
					<center><div style="color: #db2e2e; font-weight: bold; display:none" class="wrong-cred">Wrong Email or Password</div></center>
				</div>
		    	<table border="0" style="margin-right:15px;">
		    		<tr>
		    			<td>
		    				<div class="row">
		    					<div class="hidden-xs col-sm-12" style="margin-right:40px">
		    						<span class="login-lock-icon"></span>
		    					</div>
		    				</div>
		    			</td>
		    			<td>
		    				<div class="row">
					        	<div class="col-xs-12">
					        		<input type="hidden" name="token" value={{ Session::get('reset-form') }}>
					        		<input type="email" id="email-reset-form" name="email" placeholder="* Email id" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
					        		<span class="glyphicon glyphicon-remove inp-syb email-reset-form-glyphicon" aria-hidden="true" style="display:none"></span>
					        	</div>
					        	<div class="col-xs-12">
					        		<input type="password" id="pass-reset-form" name="password" placeholder="* Password" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
					        		<span class="glyphicon glyphicon-remove inp-syb pass-reset-form-glyphicon" aria-hidden="true" style="display:none"></span>
					        		<span class="min6char" style="color:#db2e2e; display:none; font-size:10px; font-weight: bold;">Password must be more than 5 characters!</span>
					        	</div>
					        	<div class="col-xs-12">
					        		<input type="password" id="conf-pass-reset-form" name="password_confirmation" placeholder="* Confirmation Password" class="inputfield" style="margin-bottom:20px; height:40px; font-size:18px">
					        		<span class="glyphicon glyphicon-remove inp-syb conf-pass-reset-form-glyphicon" aria-hidden="true" style="display:none"></span>
					        	</div>
					        	<div class="col-xs-12" style="font-size: 16px; text-align:right; margin-bottom:10px; display:none">
					        		<a class="forgot-password" style="cursor: pointer" >Forgot Password</a>
					        	</div>
					        </div>
		        		</td>
		    		</tr>
		    	</table>
	    	</div> 
	    	<div class="modal-footer" style="padding-top:0px;">
	    		<div class="row">
		    		<div class="col-xs-12">
		    			<center>
		    				<button type="submit" onclick="return newpassSubmit();" style="width:80%; margin-top:10px" class="btn-lg btn-red"><a class="power-icon-login"></a>RESET</button>
		    			</center>
					</div>
				</div>
    		</div>
    	</form>
    </div>
  </div>
</div>
@endif


<!-- START TOP HEADER OF THE PAGE -->
<div id="top-header" class="container-fluid hidden-xs" style="background: #000;">
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
    	<div class="hidden-xs col-sm-5 col-md-4 col-lg-6">
    		<a class="head-text icon-mail" href="mailto:support@foodfire.in">support@foodfire.in</a>
    		&nbsp;&nbsp;
    		<span class="head-text icon-phone"> 09712318526 </span>
    	</div>
    	<!-- MOBILE HEAD PART IF YOU WOULD LIKE TO PREFER MAIL AND MOB NUM-->
    	<!-- <div class="col-xs-12 hidden-sm hidden-md hidden-lg" style="margin-bottom:5px">
    		<center>
    		<a class="head-text icon-mail" href="mailto:shah.aashay21@gmail.com">foodfireonline@gmail.com</a>
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<span class="head-text icon-phone"> 09712318526 </span>
    		</center>
    	</div> -->
		@if(Auth::check())
			<div class="hidden-xs col-sm-4 col-md-4 col-lg-3 php-log-in">
				<center>
					<span class="dropdown">
						<span style="color:white; font-weight:bold" class="head-text dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-user fa-lg"></i> <?php echo ucwords(Auth::user()->username); ?> <i class="fa fa-caret-down"></i></span>
						<ul class="dropdown-menu dropdown-menu-center dropdown-menu-arrow">
							<li><a href="{{ URL::route('usershome') }}"><i class="fa fa-user"></i> Account</a></li>
							<li><a href="{{ URL::route('usersprofile') }}"><i class="fa fa-briefcase"></i> Profile</a></li>
							<li><a href="{{ URL::route('usersorders') }}"><i class="fa fa-list"></i> Orders</a></li>
							<li><a href="{{ URL::route('usersreviews') }}"><i class="fa fa-comments"></i> Reviews</a></li>
							<li><a style="color:inherit; font-size:inherit; font-weight:inherit; margin-left:0px" class="logout"><i class="fa fa-power-off"></i> Logout</a></li>
						</ul>
					</span>
					&nbsp;<span style="border: 1px solid #db2e2e;"></span>
					<span class="logout">Log out</span>
				</center>
			</div>
		@else
			<div class="hidden-xs col-sm-4 col-md-4 col-lg-3 php-log-out">
				<center>
					<span class="head-text icon-login login-click" data-toggle="modal" data-target=".login-modal">LOGIN</span>
					&nbsp;<span style="border: 1px solid #db2e2e;"></span>
					&nbsp;<span style="font-size: 10px; color:#858585">Not a Member?</span>
					<span class="head-text icon-lock register-click" data-toggle="modal" data-target=".register-modal">REGISTER NOW</span>
				</center>
			</div>
		@endif

		<div class="hidden-xs col-sm-4 col-md-4 col-lg-3 ajax-logged-in" style="display:none">
			<center>
				<span class="dropdown">
					<span style="color:white; font-weight:bold" class="head-text user-name dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i> </span>	
					<ul class="dropdown-menu dropdown-menu-center dropdown-menu-arrow">
						<li><a href="{{ URL::route('usershome') }}"><i class="fa fa-user"></i> Account</a></li>
						<li><a href="{{ URL::route('usersprofile') }}"><i class="fa fa-briefcase"></i> Profile</a></li>
						<li><a href="{{ URL::route('usersorders') }}"><i class="fa fa-list"></i> Orders</a></li>
						<li><a href="{{ URL::route('usersreviews') }}"><i class="fa fa-comments"></i> Reviews</a></li>
						<li><a style="color:inherit; font-size:inherit; font-weight:inherit; margin-left:0px" class="logout"><i class="fa fa-power-off"></i> Logout</a></li>
					</ul>
				</span>
				&nbsp;<span style="border: 1px solid #db2e2e;"></span>
				<span class="logout">Log out</span>
			</center>
		</div>

		<div class="hidden-xs col-sm-4 col-md-4 col-lg-3 ajax-logged-out" style="display:none">
			<center>
				<span class="head-text icon-login login-click" data-toggle="modal" data-target=".login-modal">LOGIN</span>
				&nbsp;<span style="border: 1px solid #db2e2e;"></span>
				&nbsp;<span style="font-size: 10px; color:#858585">Not a Member?</span>
				<span class="head-text icon-lock register-click" data-toggle="modal" data-target=".register-modal">REGISTER NOW</span>
			</center>
		</div>


		
		<div class="hidden-xs col-sm-3 col-md-3 col-lg-2">
			<a href="#" class="head-icon icon-fb"></a>
			<a href="#" class="head-icon icon-twitter"></a>
			<a href="https://www.google.com/+FoodfireIn" class="head-icon icon-google"></a>
		</div>
		<!-- FOR MOBILE TOP MENU IF YOU WOULD LIKE IT IN EXISTING DIVISION BUT THERE IS ADDING PROBLEM -->
		<!-- <div class="col-xs-4 hidden-sm hidden-md hidden-lg">
				Website Name
		</div>
		<div class="col-xs-8 hidden-sm hidden-md hidden-lg" style="text-align: right">
			<a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".login-modal"><i class="fa fa-user fa-fw"></i> LOGIN</a>
			&nbsp;
			<a class="btn btn-danger btn-sm" data-toggle="modal" data-target=".register-modal"><i class="fa fa-user-plus fa-fw"></i> SIGNUP</a>
		</div> -->
		
    </div>
</div>
<!-- FOR MOBILE TOP MENU -->
<div id="top-header" class="container-fluid visible-xs" style="position:fixed; z-index:990; width:100%; margin-right:0px; background: #000; padding-top: 7px; padding-bottom: 7px;">
	<div class="row">
		<div class="col-xs-3">
			<a class="btn btn-success btn-xs open-left-slide"><span class="mobile-menu-button"></span></a>
		</div>
		@if(Auth::check())
			<div class="col-xs-6 php-log-in">
				<center>
					<span class="dropdown">
						<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i></a>
						<ul class="dropdown-menu dropdown-menu-center dropdown-menu-arrow">
							<li><a href="{{ URL::route('usershome') }}"><i class="fa fa-user"></i> Account</a></li>
							<li><a href="{{ URL::route('usersprofile') }}"><i class="fa fa-briefcase"></i> Profile</a></li>
							<li><a href="{{ URL::route('usersorders') }}"><i class="fa fa-list"></i> Orders</a></li>
							<li><a href="{{ URL::route('usersreviews') }}"><i class="fa fa-comments"></i> Reviews</a></li>
							<li><a style="color:inherit; font-size:inherit; font-weight:inherit; margin-left:0px" class="logout"><i class="fa fa-power-off"></i> Logout</a></li>
						</ul>
					</span>
					&nbsp;
					<!-- <a class="btn btn-danger icon-login btn-sm logout"> LOG OUT</a> -->
					<a class="btn btn-danger btn-sm fa fa-power-off logout" style="color:#fff; font-weight:normal"></a>
				</center>
			</div>
		@else
			<div class="col-xs-6 php-log-out">
				<center>
					<a class="btn btn-primary btn-sm login-click" data-toggle="modal" data-target=".login-modal"><i class="fa fa-user fa-fw"></i></a>
					&nbsp;
					<a class="btn btn-danger btn-sm mob-register-click" data-toggle="modal" data-target=".register-modal"><i class="fa fa-user-plus fa-fw"></i></a>
				</center>
			</div>
		@endif

		<div class="col-xs-6 ajax-logged-in" style="display:none">
			<center>
				<span class="dropdown">
					<a class="btn btn-primary btn-sm mob-user-name dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-center dropdown-menu-arrow">
						<li><a href="{{ URL::route('usershome') }}"><i class="fa fa-user"></i> Account</a></li>
						<li><a href="{{ URL::route('usersprofile') }}"><i class="fa fa-briefcase"></i> Profile</a></li>
						<li><a href="{{ URL::route('usersorders') }}"><i class="fa fa-list"></i> Orders</a></li>
						<li><a href="{{ URL::route('usersreviews') }}"><i class="fa fa-comments"></i> Reviews</a></li>
						<li><a style="color:inherit; font-size:inherit; font-weight:inherit; margin-left:0px" class="logout"><i class="fa fa-power-off"></i> Logout</a></li>
					</ul>
				</span>
				&nbsp;
				<a class="btn btn-danger btn-sm fa fa-power-off logout"  style="color:#fff; font-weight:normal"></a>
			</center>
		</div>

		<div class="col-xs-6 ajax-logged-out" style="display:none">
			<center>
				<a class="btn btn-primary btn-sm login-click" data-toggle="modal" data-target=".login-modal"><i class="fa fa-user fa-fw"></i></a>
				&nbsp;
				<a class="btn btn-danger btn-sm mob-register-click" data-toggle="modal" data-target=".register-modal"><i class="fa fa-user-plus fa-fw"></i></a>
			</center>
		</div>
		
		<div class="col-xs-3" style="text-align:right">
			<a href="{{ URL::route('checkout') }}" class="btn btn-warning btn-sm" style="padding:0px 7px"><span class="fa fa-shopping-cart" style="font-size: 24px" aria-hidden="true"></span><span class="badge product-total" style="background:#db2e2e; padding:2px 6px; margin-left:5px; top:-4px"></span></a>
		</div>
	</div>


</div>
<!-- END TOP HEADER OF THE PAGE -->

<!-- START MENU -->
<div class="hidden-xs">
	<!-- <nav class="navbar-inverse" style="background: #1d1d1d; padding-bottom: 8px; padding-top: 7px;"> -->
	<nav class="navbar-inverse" style="background: #000000; padding-bottom: 8px; padding-top: 7px; margin-top:-1px">
	  <div class="container">
	    <div class="navbar-header">
	      <!-- <a class="navbar-brand wow bounceInRight" href="#"> -->
	      <a class="navbar-brand rightt" href="{{url('/')}}">
	      <img alt="FoodFire" style="margin-top: -15px; float:left" src="{{ URL::asset('public/images/foodfire.png') }}" class="img-responsive">
	      <!-- <img style="margin-top: -5px;" src="{{ URL::asset('public/images/fire.gif') }}" class="img-responsive"> -->
	      </a>
	    </div>
	    <div class="collapse navbar-collapse">
	      <ul class="nav navbar-nav navbar-right">

	      	
	      	<li class="bottom-border-hover dropdown">
	      		<!-- <span class="dropdown"> -->
	      			<a style="cursor:pointer" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-map-marker fa-lg"></i> Anand</a>
	      			<ul class="dropdown-menu dropdown-menu-center dropdown-menu-arrow" style="border-radius:4px; width:180px">
	      				<li class="disabled"><a>Ahmedabad<span style="font-size:9px"> (Coming Soon)</span></a></li>
	      				<li class="disabled"><a>Vadodara<span style="font-size:9px"> (Coming Soon)</span></a></li>
	      			</ul>
	      		<!-- </span> -->
	      	</li>

	        <li class="bottom-border-hover"><a href="{{ URL::route('index') }}"><i class="fa fa-home fa-lg"></i> HOME</a></li>

	        <!-- <li class="dropdown bottom-border-hover">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#">SPECIAL <span class="caret"></span></a>
	          <ul class="dropdown-menu" style="background:#000; margin-top:3px;">
	            <li><a class="text-red-effect" style="color:#fff;" href="#">Page 1-1</a></li>
	            <li><a href="#" style="color:#fff;">Page 1-2</a></li>
	            <li><a href="#" style="color:#fff;">Page 1-3</a></li>
	          </ul>
	        </li>

	        <li class="bottom-border-hover"><a href="#">COMBOS</a></li> -->

	        <li class="dropdown dropdown-hover bottom-border-hover" style="padding-right:10px">
	        	<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="float:left"><i class="fa fa-shopping-cart fa-lg"></i> CART<span class="badge product-total" style="background:#db2e2e; padding:2px 6px; margin-left:3px; margin-top:-5px; position:absolute"></span></a>
	        	<ul class="cart-dropdown" style="background:#000; margin-top:2px; min-width:190px; display:none">
		            <li style="border-bottom:1px dashed #4b4b4b; padding:10px 15px; font-size:12px">
		            	<div class="row">
		            		<div class="col-sm-8">
		            			<span class="text-red-effect" style="color:#fff; float:left" href="#">YOUR ITEM(S):</span>
		            		</div>
		            		<div class="col-sm-4">
		            			<span class="product-total" style="color:#db2e2e; float:right; font-weight:bold"></span>		
		            		</div>
		            	</div>
		            	
		            </li>
		            <li style="border-bottom:1px dashed #4b4b4b; padding:10px 15px; font-size:12px">
		            	<div class="row">
		            		<div class="col-sm-6">
		            			<span style="color:#fff; float:left; cursor:pointer">TOTAL:</span>
		            		</div>
		            		<div class="col-sm-6">
		            			<span class="product-total-price" style="color:#db2e2e; float:right; font-weight:bold"><i class="fa fa-inr"></i> </span>		
		            		</div>
		            	</div>
		            	
		            </li>
			         <li style="padding:10px 15px; font-size:0.75em">
			         	<span>{{ HTML::linkRoute('checkout', 'PROCEED TO CHECKOUT', array(), array('class' => 'btn-red center-block text-center', 'style' => 'padding:10px 2px; font-weight:bold; margin-bottom:10px')) }}</span>
			         	<!-- <span class="btn-red center-block text-center" style="padding:10px 2px; font-weight:bold; margin-bottom:10px"></span> -->
			         	<img alt="FoodFire" class="img-responsive" style="margin-bottom:10px" src="{{ URL::asset('public/images/foodfire.png') }}" height="40px" width="150px">
			         	<span class="text-muted center-block text-center" style="font-size:0.75em;">THANKS FOR YOUR PURCHASE!</span>
			         </li>
		         	<li><img alt="" src="{{ URL::asset('public/images/ticket-serrated-borde.png') }}" width="189" style="position:absolute; margin-top:4px"></li>
	          </ul>
	        </li>

	        <li class="bottom-border-hover"><a style="cursor:pointer"><i class="fa fa-phone-square"></i> CONTACT</a></li>
	      </ul>
	      <!-- <ul class="nav navbar-nav navbar-right">
	        <li class="@yield('active-page2') bottom-border-hover"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>	      </ul> -->
	    </div>
	  </div>
	</nav>
</div>


<!-- END MENU -->