@extends('layout')

@section('title')
{{ ucwords($vendorname) }}, {{ ucwords($area) }}, {{ ucwords($city) }}, {{ ucwords($vendorname) }} Order Online - FoodFire
@stop

@section('metadesc')
<meta name="description" content="{{ ucwords($vendorname) }} {{ ucwords($city) }}; {{ ucwords($vendorname) }}, {{ ucwords($area) }};  {{ ucwords($vendorname) }} Food Delivery, {{ ucwords($vendorname) }} Order Online - FoodFire" />
@stop

@section('keywords')
<meta name="keywords" content="{{ ucwords($vendorname) }} Food Delivery, {{ ucwords($vendorname) }} {{ ucwords($city) }}, {{ ucwords($vendorname) }} Order Online, {{ ucwords($vendorname) }} Home Delivery, FoodFire" />
@stop

@section('content')
<!-- SPACE FOR MOBILE DEVICE -->
<div class="col-xs-12 visible-xs" style="height:45px"></div>

<!-- HEADER OF VENDOR INFORMATION -->
<div class="container-fluid" id="header-bottom-wrap" style="padding-bottom:20px">
	<div class="row">

		<section id="item-head" style="height: auto;">
				@foreach($vendor as $v)
					<!-- EXCEPT MOBILE -->
					<div class="col-lg-3 col-md-3 col-sm-2 hidden-xs leftt">
						<center><img class='category-item-desc' src="{{ URL::asset($v->imgsrc) }}"></center>
					</div>
					<div class="col-lg-7 col-md-6 col-sm-7 hidden-xs upp" style="color:#fff">
						
						<h1>{{ ucwords($v->vendor_name) }}</h1>

						<ul class='rate stars' data-toggle='tooltip' title='Ratings' data-placement='top'>
							@for ($j=0; $j<5; $j++)
								@if($v->ratings > $j)
									<!-- <li></li> -->
									<i class="fa fa-star" style="color:#db2e2e"></i>
								@else
									<!-- <li class='empty'></li> -->
									<i class="fa fa-star" style="color:#a0a0a0"></i>
								@endif
							@endfor
						</ul>
						<br>
						<div class='sell-details mob' style='margin-bottom: 8px;'>
							<div style='display: inline-table'><i style="color:#db2e2e" class='tooli fa fa-map-marker fa-lg' data-toggle='tooltip' title='Area Location' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($v->area) }}, {{ ucwords($v->city) }}</span></div>
							<div style='display: inline-table'><i style="color:#db2e2e" class='tooli fa fa-clock-o fa-lg' data-toggle='tooltip' data-placement='top' title='Average Cooking Time'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($v->del_time) }} Minutes</span></div>
						</div>
						<div class='sell-details mob' style='line-height: 25px'>
							@if($v->speciality != null || $v->speciality != '')
								<div style='display: inline-table'><i style="color:#db2e2e" class='fa fa-asterisk fa-lg' data-toggle='tooltip' title='Speciality' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($v->speciality) }}</span></div>
							@endif
								<div style='display: inline-table'>
								
								@if($v->veg == 1 || $v->jain == 1 || $v->swaminarayan == 1 || $v->non_veg == 1)
									<i style="color:#db2e2e; margin-right: 5px;" class='fa fa-cutlery fa-lg' data-toggle='tooltip' title='Food Diet' data-placement='top'></i>
								@endif
								@if($v->veg == 1)
									<img src="{{ URL::asset('public/images/vegetarian-20x20.png')}}" data-toggle='tooltip' title='Vegetarian' data-placement='top' class='img-responsive'>
								@endif
								@if($v->jain == 1)
									<img src="{{ URL::asset('public/images/jain-20x20.png') }}" data-toggle='tooltip' title='Jain' data-placement='top' class='img-responsive'>
								@endif
								@if($v->swaminarayan == 1)
									<img src="{{ URL::asset('public/images/swaminarayan-20x20.png') }}" data-toggle='tooltip' title='Swaminarayan' data-placement='top' class='img-responsive'>
								@endif
								@if($v->non_veg == 1)
									<img src="{{ URL::asset('public/images/non-vegetarian-20x20.png') }}" data-toggle='tooltip' title='Non Vegetarian' data-placement='top' class='img-responsive'>
								@endif

								</div>
							
							 <span style='margin-left: 9px; display: inline-table' title='Price Range' data-placement='top' data-toggle='tooltip'>
								
								@for($j=0; $j<5; $j++)
									@if($v->price > $j)
										<i style="color:#db2e2e" class='fa fa-inr fa-lg'></i>
									@endif
								@endfor
							</span>
						</div>
						<br>
						<div style="float:left">
							<span onclick="updatevalue({{ $v->vendorunkid }},'1','1')" class='btn btn-default btn-sm' title='Like' data-placement='top' data-toggle='tooltip'>
								<i class='fa fa-thumbs-up fa-white'></i>
								<span id='vendor-like-{{ $v->vendorunkid }}'>{{ $v->likes }}</span>
							</span>
							<span onclick="updatevalue({{ $v->vendorunkid }},'3','1')" class='btn btn-default btn-sm' title='Favourite' data-placement='top' data-toggle='tooltip'>
								<i class='fa fa-star fa-white'></i> 
								<span id='vendor-favourite-{{ $v->vendorunkid }}'>{{ $v->favourite }}</span>
							</span>
							<span onclick="updatevalue({{ $v->vendorunkid }},'4','1')" class='btn btn-default btn-sm' title='Visit' data-placement='top' data-toggle='tooltip'>
								<i class='fa fa-map-marker fa-lg'></i>
								<span id='vendor-visit-{{ $v->vendorunkid }}'>{{ $v->visit }}</span>
							</span>
						</div>
						<div>
							<span style="font-weight:bold; margin:5px 10px 0px 20px; float:left">Your Rating</span>
							<div class="cusrate" style="width:160px; display:table">
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','1')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Bad' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','2')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Poor' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','3')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Average' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','4')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Great' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','5')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Awesome' data-placement='top'></i>
							</div>
						</div>


					</div>


					<!-- MOBILE VERSION -->
					<div class="visible-xs col-xs-12">
						<div class="visible-xs col-xs-4 leftt">
							<center><img class='category-item-desc' style="height:90px; width:90px; margin-top:10px" src="{{ URL::asset($v->imgsrc) }}"></center>
						</div>
						<div class="visible-xs col-xs-8" style="color:#fff;">
							<center>
								<h1 style="float:none; font-size:25px">{{ ucwords($v->vendor_name) }}</h1>
							</center>
							<center>
								<ul class='rate stars' style="margin:0px" data-toggle='tooltip' title='Ratings' data-placement='top'>
									@for ($j=0; $j<5; $j++)
										@if($v->ratings > $j)
											<!-- <li></li> -->
											<i class="fa fa-star" style="color:#db2e2e"></i>
										@else
											<!-- <li class='empty'></li> -->
											<i class="fa fa-star" style="color:#a0a0a0"></i>
										@endif
									@endfor
								</ul>
							</center>
							<br>
						</div>
					</div>
					<div class="visible-xs col-xs-12" style="color:#fff; margin-top:10px">
						<center>
							<div class='sell-details mob' style='margin-bottom: 8px;'>
								<div style='display: inline-table'><i style="color:#db2e2e" class='tooli fa fa-map-marker fa-lg' data-toggle='tooltip' title='Area Location' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($v->area) }}, {{ ucwords($v->city) }}</span></div>
								<div style='display: inline-table'><i style="color:#db2e2e" class='tooli fa fa-clock-o fa-lg' data-toggle='tooltip' data-placement='top' title='Average Cooking Time'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($v->del_time) }} Minutes</span></div>
							</div>
						</center>
						<center>
							<div class='sell-details mob' style='line-height: 25px'>
								@if($v->speciality != null || $v->speciality != '')
									<div style='display: inline-table'><i style="color:#db2e2e" class='fa fa-asterisk fa-lg' data-toggle='tooltip' title='Speciality' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($v->speciality) }}</span></div>
								@endif
									<div style='display: inline-table'>
									
									@if($v->veg == 1 || $v->jain == 1 || $v->swaminarayan == 1 || $v->non_veg == 1)
										<i style="color:#db2e2e; margin-right: 5px;" class='fa fa-cutlery fa-lg' data-toggle='tooltip' title='Food Diet' data-placement='top'></i>
									@endif
									@if($v->veg == 1)
										<img src="{{ URL::asset('public/images/vegetarian-20x20.png')}}" data-toggle='tooltip' title='Vegetarian' data-placement='top' class='img-responsive'>
									@endif
									@if($v->jain == 1)
										<img src="{{ URL::asset('public/images/jain-20x20.png') }}" data-toggle='tooltip' title='Jain' data-placement='top' class='img-responsive'>
									@endif
									@if($v->swaminarayan == 1)
										<img src="{{ URL::asset('public/images/swaminarayan-20x20.png') }}" data-toggle='tooltip' title='Swaminarayan' data-placement='top' class='img-responsive'>
									@endif
									@if($v->non_veg == 1)
										<img src="{{ URL::asset('public/images/non-vegetarian-20x20.png') }}" data-toggle='tooltip' title='Non Vegetarian' data-placement='top' class='img-responsive'>
									@endif

									</div>
								
								 <span style='margin-left: 9px; display: inline-table' title='Price Range' data-placement='top' data-toggle='tooltip'>
									
									@for($j=0; $j<5; $j++)
										@if($v->price > $j)
											<i style="color:#db2e2e" class='fa fa-inr fa-lg'></i>
										@endif
									@endfor
								</span>
							</div>
						</center>
						<br>
						<div style="float:left; margin-top:15px">
							<span onclick="updatevalue({{ $v->vendorunkid }},'1','1')" class='btn btn-default btn-sm' title='Like' data-placement='top' data-toggle='tooltip'>
								<i class='fa fa-thumbs-up fa-white'></i>
								<span id='mobvendor-like-{{ $v->vendorunkid }}'>{{ $v->likes }}</span>
							</span>
							<span onclick="updatevalue({{ $v->vendorunkid }},'3','1')" class='btn btn-default btn-sm' title='Favourite' data-placement='top' data-toggle='tooltip'>
								<i class='fa fa-star fa-white'></i> 
								<span id='mobvendor-favourite-{{ $v->vendorunkid }}'>{{ $v->favourite }}</span>
							</span>
							<span onclick="updatevalue({{ $v->vendorunkid }},'4','1')" class='btn btn-default btn-sm' title='Visit' data-placement='top' data-toggle='tooltip'>
								<i class='fa fa-map-marker fa-lg'></i>
								<span id='mobvendor-visit-{{ $v->vendorunkid }}'>{{ $v->visit }}</span>
							</span>
						</div>
						<div style="float:right">
							<span style="font-weight:bold; margin:0px 10px 0px 20px;">Your Rating</span>
							<div class="cusratemob" style="width:160px; display:table">
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','1')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Bad' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','2')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Poor' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','3')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Average' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','4')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Great' data-placement='top'></i>
								<i onclick="updatevalue({{ $v->vendorunkid }},'2','5')" class="fa fa-star fa-2x" style="cursor:pointer" data-toggle='tooltip' title='Awesome' data-placement='top'></i>
							</div>
						</div>
					</div>
					<!-- MOBILE VERSION OVER -->

					
					<div class="col-lg-2 col-md-3 col-sm-3 hidden-xs rightt">
						@if( $v->ratings >= 4.5)
							<?php $rat = 'Awesome';
								  $backcolor = '#78c928';
								  $border = '#60a533';
							?>
						@elseif($v->ratings < 4.5 && $v->ratings >= 3.5)
							<?php $rat = 'Good';
								  $backcolor = '#3498db';
								  $border = '#2980b9';
							 ?>
						@elseif($v->ratings < 3.5 && $v->ratings >= 2.5)
							<?php $rat = 'Average';
								  $backcolor = '#f1c40f';
								  $border = '#f39c12';
							 ?>
						@elseif($v->ratings < 2.5 && $v->ratings >= 1.5)
							<?php $rat = 'Poor';
								  $backcolor = '#e67e22';
								  $border = '#d35400';
							 ?>
						@elseif($v->ratings < 1.5)
							<?php $rat = 'Bad';
								  $backcolor = '#e74c3c';
								  $border = '#c0392b';
							 ?>
						@endif
						<div class="btn btn-default" style="padding:0 0 0 10px; min-height:38px; border:none; margin-top:40px; display: table">
							

							@if( $v->votes == 0)
								<span style="float:left; margin-right:5px; margin-top: 5px">
									<span style="font-weight:bold; font-size:15px;">No Ratings Yet</span>
								</span>
							@else
								<span style="float:left; margin-right:5px">
									<span style="font-weight:bold; font-size:15px">{{ $rat }}</span>
									<span style="font-size:9px; display:block">{{ $v->votes }} User Votes</span>
								</span>
								<span class="btn btn-green" style="background:{{ $backcolor }} ;border-bottom:solid {{ $border }}; font-size:19px; padding: 4px 7px">{{ $v->ratings }}</span>
							@endif
						</div>
						<div class="btn btn-default btn-review" data-toggle="modal" data-target="#reviewmodal" style="margin-top:20px">
							<i class="fa fa-plus"></i>
							<span><b>Write a Review</b></span>
						</div>
					</div>
				@endforeach
		</section>

	</div>
</div>

<!-- WRITE A REVIEW MODAL -->
<div class="modal fade" id="reviewmodal">
	<div class="modal-dialog">
		<div class="modal-content" style="font-size:18px">
			<form class="review-form">
				<div class="modal-header">
					<button type="button" class="ff-btn-modal-close pull-right" data-dismiss="modal">
						<i class="fa fa-times fa-white fa-lg"></i>
					</button>
					<h4 class="modal-title"><i class="fa fa-comments"></i> Write a review</h4>
				</div>
				<div class="modal-body">

					<div>
						<input type="checkbox" checked="" style="height:14px; margin-left:10px" name="vendor_like" value="1">
						<i class="fa fa-thumbs-up"></i>
						Like    
						<input type="checkbox" checked="" style="height:14px; margin-left:10px" name="vendor_favourite" value="1">
						<i class="fa fa-star"></i>
						Favourite    
						<input type="checkbox" checked="" style="height:14px; margin-left:10px" name="vendor_visit" value="1">
						<i class="fa fa-map-marker fa-large"></i>
						Visited
					</div>

					<div class="row" style="margin-top:10px">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<textarea class="input_text_box form-control" name="user_review" id="user_review" placeholder="* Your Review" rows="5" cols="30" name="text"></textarea>
						</div>
					</div>

					<div class="row" style="margin-top:10px">
						<div class="col-md-3 col-xs-12" id="rate">
							* Ratings
						</div>
						<div class="col-md-9 col-xs-12">
							<div class="cusratemodal" style="width:160px; display:table">
								<i onclick="orderrate = 1; reviewratecolourin(orderrate-1);" class="fa fa-star" style="cursor:pointer" data-toggle='tooltip' title='Bad' data-placement='top'></i>
								<i onclick="orderrate = 2; reviewratecolourin(orderrate-1);" class="fa fa-star" style="cursor:pointer" data-toggle='tooltip' title='Poor' data-placement='top'></i>
								<i onclick="orderrate = 3; reviewratecolourin(orderrate-1);" class="fa fa-star" style="cursor:pointer" data-toggle='tooltip' title='Average' data-placement='top'></i>
								<i onclick="orderrate = 4; reviewratecolourin(orderrate-1);" class="fa fa-star" style="cursor:pointer" data-toggle='tooltip' title='Great' data-placement='top'></i>
								<i onclick="orderrate = 5; reviewratecolourin(orderrate-1);" class="fa fa-star" style="cursor:pointer" data-toggle='tooltip' title='Awesome' data-placement='top'></i>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary btn-lg" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- ITEM PAGE OWN MENU -->
<div class="container-fluid image-menu" style="font-weight:bold; background: #f6f6f6; height:62px;">
	<div class="row">
		<div class="col-lg-2 visible-lg">
			
		</div>
		<div class="col-lg-7 col-sm-12 col-md-12 hidden-xs" style="padding-top:0">
			
				<ul class="menu2" style="margin-top:25px">
					<li class="menu2-menu"><i class="fa fa-list"></i> Menu</li>
					<li class="menu2-info"><i class="fa fa-clock-o"></i> Information</li>
					<li class="menu2-reviews"><i class="fa fa-star"></i> Reviews</li>
				</ul>
			
		</div>
		<!-- MOBILE DEVICE -->
		<div class="visible-xs col-xs-12" style="padding: 0px">
			<ul class="menu2" style="width:auto; margin: 25px auto; display:table">
				<li class="menu2-menu" style="padding-left: 0px"><i class="fa fa-list"></i> Menu</li>
				<li class="menu2-info"><i class="fa fa-clock-o"></i> Info</li>
				<li class="menu2-reviews" style="padding-right:0px"><i class="fa fa-star"></i> Reviews</li>
			</ul>
		</div>
		<!-- END -->
		<div class="col-lg-3 visible-lg">
			
		</div>
	</div>
</div>



<div class="container-fluid" style="margin-top:20px">
	<div class="row">
		<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 products-details">

				{{ $cart }}
				
		</div>

		<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 menu-info" style="display:none">

				Menu Information
				
		</div>

		<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 menu-review" style="display:none; padding:0 10px">

				<div class="panel panel-foodfire">
					<div class="panel-heading">
						<div class="panel-title" style="height:35px; line-height:33px; font-size:16px;">
							<span class="pull-left">
								<i class="fa fa-comments-o"></i>
								User Reviews   
							</span>
							<div class="btn-edit btn-default-edit pull-right" style="background:#f1f1f1; padding:0 0 0 10px; min-height:38px; border:none; display: table">
								<span style="float:left; margin:5px 10px 5px 0px">
									<span style="font-weight:bold; font-size:13px;">No Ratings Yet</span>
								</span>
							</div>
						</div>
					</div>
					<div class="panel-body" style="padding:5px 10px">
						<div class="review-list">
							<div class="row">
								<div class="pull-left">
									<b style="font-size:16px; margin-right:5px">Aashay Shah</b>
									05/07/2015
								</div>
								<div class="btn-edit btn-default-edit pull-right" style="background:#f1f1f1; padding:0 0 0 10px; min-height:38px; border:none; display: table">
							

								@if( $v->votes == 0)
									<span style="float:left; margin-right:5px; margin-top: 5px">
										<span style="font-weight:bold; font-size:15px;">No Ratings Yet</span>
									</span>
								@else
									<span style="float:left; margin:5px 8px 0 0">
										<span style="font-weight:bold; font-size:15px">{{ $rat }}</span>
									</span>
									<span class="btn btn-green" style="background:{{ $backcolor }} ;border-bottom:solid {{ $border }}; font-size:19px; padding: 4px 7px">{{ $v->ratings }}</span>
								@endif
							</div>
							</div>
							<div class="margin-top-10 row">
								<div class="text">I have placed online order to dynamite.. Really awesome food taste & very much happy with the quality of food. I have never taste this kind of food anywhere in Baroda. Now baroda is getting mumbai's taste.. Cheers to dynamite.</div>
							</div>
						</div>
					</div>
				</div>
				
		</div>

		<div id="product-cart" class="col-lg-3 col-md-4 col-sm-4 hidden-xs" style="margin-top: -20px;">
			<div id="wrap-sticky" style="padding-top:5px">
				
			</div>




			<!-- <div class="items-category-white-box">
				<h1>
			    	<b>YOUR ORDER</b><i class="fa fa-briefcase fa-2x" style="color:#db2e2e; float:right; margin-right:30px"></i>
			  	</h1>
			  	<hr><hr><br>

			  	<div class="approx-time">
			  		<b>Approx. Delivery Time : </b>
			  		<div style="display:inline-table">
			  			11:53 PM
			  			<i class="fa fa-clock-o fa-lg"></i>
			  		</div>
			  	</div>

			  	<div class="cart-vendor" style="font-size: 14px">
			  		
		  			<div class="cart-seller">
			  			<a style="text-decoration:none" href="">
			  				<b>Sahyog - Motazar</b>
			  			</a>
			  			<div class="container-fluid">
				  			<div class="row">
				  				<div class="seller-product" style="font-size:13px">
					  				<div class="col-sm-6 no-padding" style="padding-left:5px">
					  					<span class="product-name">Idli Sambhar</span>
					  					<div class="col-sm-12 no-padding">
					  						<small>- Vegetarian</small>
					  					</div>
					  					<div class="col-sm-12 no-padding">
					  						<small>- Spicy</small>
					  					</div>
					  					<div class="col-sm-8 no-padding">
					  						<small>- Mustard</small>
					  					</div>
					  					<div class="col-sm-4 no-padding">
					  						<small style="float:right;"><i class="fa fa-inr"></i> 20.00</small>
					  					</div>	
					  				</div>
					  				<div class="col-sm-1 no-padding">
					  					1
					  				</div>
					  				<div class="col-sm-1 no-padding">
					  					<a><i class="fa fa-times fa-white" style="cursor:pointer;"></i></a>
					  				</div>
					  				<div class="col-sm-4 no-padding" style="text-align:right">
					  					<i class="fa fa-inr"></i> 140.00
					  				</div>
					  			</div>
				  			</div>
			  			</div>

			  			<div class="container-fluid">
				  			<div class="row">
				  				<div class="seller-product" style="font-size:13px">
					  				<div class="col-sm-6 no-padding" style="padding-left:5px">
					  					<span class="product-name">Idli Sambhar</span><br>
					  					-
					  					<small>Vegetarian</small>
					  				</div>
					  				<div class="col-sm-1 no-padding">
					  					1
					  				</div>
					  				<div class="col-sm-1 no-padding">
					  					<a><i class="fa fa-times fa-white" style="cursor:pointer;"></i></a>
					  				</div>
					  				<div class="col-sm-4 no-padding" style="text-align:right">
					  					<i class="fa fa-inr"></i> 140.00
					  				</div>
					  			</div>	
				  			</div>
			  			</div>

			  			<div class="container-fluid">
				  			<div class="row" style="text-align:right">
				  				<div class="col-sm-8 no-padding">
					  				Vendor Sub-Total:
					  			</div>
					  			<div class="col-sm-4 no-padding">
					  				<i class="fa fa-inr"></i> 280.00
					  			</div>	
				  			</div>
			  			</div>

		  			</div>
			  		
		  			<div class="cart-seller">
			  			<a style="text-decoration:none" href="">
			  				<b>Sahyog - Motazar</b>
			  			</a>
			  			<div class="container-fluid">
				  			<div class="row">
				  				<div class="seller-product" style="font-size:13px">
					  				<div class="col-sm-6 no-padding" style="padding-left:5px">
					  					<span class="product-name">Idli Sambhar</span><br>
					  					-
					  					<small>Vegetarian</small>
					  				</div>
					  				<div class="col-sm-1 no-padding">
					  					1
					  				</div>
					  				<div class="col-sm-1 no-padding">
					  					<a><i class="fa fa-times fa-white" style="cursor:pointer;"></i></a>
					  				</div>
					  				<div class="col-sm-4 no-padding" style="text-align:right">
					  					<i class="fa fa-inr"></i> 140.00
					  				</div>
					  			</div>	
				  			</div>
			  			</div>

			  			<div class="container-fluid">
				  			<div class="row" style="text-align:right">
				  				<div class="col-sm-8 no-padding">
					  				Vendor Sub-Total:
					  			</div>
					  			<div class="col-sm-4 no-padding">
					  				<i class="fa fa-inr"></i> 140.00
					  			</div>	

					  			<div class="col-sm-8 no-padding">
					  				Taxes (Vendor):
					  			</div>
					  			<div class="col-sm-4 no-padding">
					  				<i class="fa fa-inr"></i> 5.08
					  			</div>
				  			</div>
			  			</div>
		  			</div>
			  		
			  		
		  			<div class="cart-seller" style="border-width:5px">
		  				<div class="container-fluid">
			  				<div class="row" style="text-align:right">
			  					<div class="col-sm-8 no-padding">
					  				Sub-Total:
					  			</div>
					  			<div class="col-sm-4 no-padding">
					  				<i class="fa fa-inr"></i> 420.00
					  			</div>

					  			<div class="col-sm-8 no-padding">
					  				Taxes (Vendor):
					  			</div>
					  			<div class="col-sm-4 no-padding">
					  				<i class="fa fa-inr"></i> 5.08
					  			</div>

					  			<div class="col-sm-8 no-padding">
					  				Multi-Vendor Delivery:
					  			</div>
					  			<div class="col-sm-4 no-padding">
					  				<i class="fa fa-inr"></i> 50.00
					  			</div>

					  			<div class="col-sm-8 no-padding">
					  				Service Tax(Delivery - 14%):
					  			</div>
					  			<div class="col-sm-4 no-padding">
					  				<i class="fa fa-inr"></i> 7.00
					  			</div>
			  				</div>
		  				</div>

		  				<div class="container-fluid">
		  					<div class="row">
			  					<center>
				  					<div class="cart-total">
				  						<div class="col-sm-6">
							  				Total:
							  			</div>
							  			<div class="col-sm-6">
							  				<i class="fa fa-inr"></i> 482.08
							  			</div>
				  					</div>
			  					</center>
			  				</div>
		  				</div>
		  			</div>

		  			<div class="cart-seller">
		  				<div class="row">
		  					<div class="btn btn-success cart-checkout">
		  						Checkout
		  					</div>
		  				</div>
		  			</div>
			  		

			  	</div> 
		  		
			  	
			</div> -->





		</div>
	</div>
</div>

<!-- PRODUCT DETAIL AS MODAL WINDOW USING AJAX CALL -->
<div id="prodetail"></div>

@stop

@section('javascr')
{{ HTML::script('js/jquery.sticky.js') }}
<script type="text/javascript">

$('body').css('background','#fafafa');
var vendor = <?php echo json_encode($vendor); ?>;
var userrate;
<?php if(isset($rating) && $rating[0] != '' && $rating[0] != null){ ?>
	var rating = <?php echo $rating; ?>;
	userrate = rating[0].rate;
	ratecolourin((userrate)-1);
	// console.log(rating[0].rate);
<?php } ?>

$('.cusrate, .cusratemob').hover(function(){
},function(){
	resetratecolour();
	if(typeof userrate != 'undefined'){
		ratecolourin((userrate)-1);
	}
});
if(!('ontouchstart' in window)){
	$('.cusrate i:eq(0), .cusratemob i:eq(0)').hover(function(){
		ratecolourin(0);
	});
	$('.cusrate i:eq(1), .cusratemob i:eq(1)').hover(function(){
		ratecolourin(1);
	});
	$('.cusrate i:eq(2), .cusratemob i:eq(2)').hover(function(){
		ratecolourin(2);
	});
	$('.cusrate i:eq(3), .cusratemob i:eq(3)').hover(function(){
		ratecolourin(3);
	});
	$('.cusrate i:eq(4), .cusratemob i:eq(4)').hover(function(){
		ratecolourin(4);
	});
}

function ratecolourin(x){
	resetratecolour();
	for(var i=0; i<=x; i++){
		if(i==0){
			$('.cusrate i:eq(0), .cusratemob i:eq(0)').css('color', '#d9534f');
		}else if(i==1){
			$('.cusrate i:eq(1), .cusratemob i:eq(1)').css('color', '#f0ad4e');
		}else if(i==2){
			$('.cusrate i:eq(2), .cusratemob i:eq(2)').css('color', '#5bc0de');
		}else if(i==3){
			$('.cusrate i:eq(3), .cusratemob i:eq(3)').css('color', '#428bca');
		}else if(i==4){
			$('.cusrate i:eq(4), .cusratemob i:eq(4)').css('color', '#5cb85c');
		}
	}
}
function resetratecolour(){
	$('.cusrate i:eq(0), .cusrate i:eq(1), .cusrate i:eq(2), .cusrate i:eq(3), .cusrate i:eq(4)').css('color', '#fff');
	$('.cusratemob i:eq(0), .cusratemob i:eq(1), .cusratemob i:eq(2), .cusratemob i:eq(3), .cusratemob i:eq(4)').css('color', '#fff');
}



//REVIEW RATINGS
// var orderrate
$('.cusratemodal').hover(function(){
},function(){
	reviewresetratecolour();
	if(typeof orderrate != 'undefined'){
		reviewratecolourin(orderrate-1);
	}
});
if(!('ontouchstart' in window)){
	$('.cusratemodal i:eq(0)').hover(function(){
		reviewratecolourin(0);
	});
	$('.cusratemodal i:eq(1)').hover(function(){
		reviewratecolourin(1);
	});
	$('.cusratemodal i:eq(2)').hover(function(){
		reviewratecolourin(2);
	});
	$('.cusratemodal i:eq(3)').hover(function(){
		reviewratecolourin(3);
	});
	$('.cusratemodal i:eq(4)').hover(function(){
		reviewratecolourin(4);
	});
}

function reviewratecolourin(x){
	reviewresetratecolour();
	for(var i=0; i<=x; i++){
		if(i==0){
			$('.cusratemodal i:eq(0)').css('color', '#d9534f');
		}else if(i==1){
			$('.cusratemodal i:eq(1)').css('color', '#f0ad4e');
		}else if(i==2){
			$('.cusratemodal i:eq(2)').css('color', '#5bc0de');
		}else if(i==3){
			$('.cusratemodal i:eq(3)').css('color', '#428bca');
		}else if(i==4){
			$('.cusratemodal i:eq(4)').css('color', '#5cb85c');
		}
	}
}
function reviewresetratecolour(){
	$('.cusratemodal i:eq(0), .cusratemodal i:eq(1), .cusratemodal i:eq(2), .cusratemodal i:eq(3), .cusratemodal i:eq(4)').css('color', '#5e5e5e');
}


//MENU HOVER EFFECT
var menu2menu = 1;
var menu2info = 0;
var menu2reviews = 0;
$('.menu2-menu').css('border-bottom', 'solid 3px #db2e2e');
$('.image-menu li').hover(function(){
	$(this).css('border-bottom', 'solid 3px #db2e2e');
}, function(){
	$(this).css('border-bottom', 'solid 3px #f6f6f6');
	if(menu2menu == 1){
		$('.menu2-menu').css('border-bottom', 'solid 3px #db2e2e');
	}else if(menu2info == 1){
		$('.menu2-info').css('border-bottom', 'solid 3px #db2e2e');
	}else if(menu2reviews == 1){
		$('.menu2-reviews').css('border-bottom', 'solid 3px #db2e2e');
	}
});
$('.image-menu li').click(function(){
	menu2menu = 0;
	menu2info = 0;
	menu2reviews = 0;
	$('.products-details').hide();
	$('.menu-info').hide();
	$('.menu-review').hide();
	$('.image-menu li').css('border-bottom', 'solid 3px #f6f6f6');
	$(this).css('border-bottom', 'solid 3px #db2e2e');
	if($(this).hasClass('menu2-menu')){
		menu2menu = 1;
		$('.products-details').show('slide',100);
	}else if($(this).hasClass('menu2-info')){
		menu2info = 1;
		$('.menu-info').show('slide',100);
	}else if($(this).hasClass('menu2-reviews')){
		menu2reviews = 1;
		$('.menu-review').show('slide',100);
	}
});



//SUBMIT USER REVIEW
$('#reviewmodal').on('show.bs.modal', function (e) {
	$(".input_text_box").val('');
	$(".input_text_box").removeClass("inputerr");
	$(".ff-text-danger").remove();
	delete orderrate;
	reviewresetratecolour();
})

$(".review-form").submit(function(e){
	e.preventDefault();
	var reviewdata = $(".review-form").serializeArray();
	reviewdata.push({name: "_token", value: token});
	reviewdata.push({name: "id", value: vendor[0].vendorunkid});
	if(typeof orderrate != 'undefined'){
		reviewdata.push({name: "rate", value: orderrate});
	}

	var addaddress = $.ajax({
		type: "POST",
		url: "/vendor/add/review",
		data: reviewdata,
		dataType: "json",
		timeout: 4000,
		success: function(response){
			if(response["modal"] == 0){
				$("#reviewmodal").modal("hide");
			}							
			if(response["alert"]){
				alertline(response["alerttype"],"<b>"+response["message"]+"</b>");
			}else{
				$("#reviewmodal").modal("handleUpdate");
				$(".input_text_box").removeClass("inputerr");
				$(".ff-text-danger").remove();
				$.each(response["message"], function(i,item){
					if(i != 'rate'){
						$("#"+i).addClass("inputerr");
					}
					$("#"+i).before("<div class=\'col-xs-12 ff-text-danger\'>"+item+"</div>");
				});
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
	        if(textStatus=="timeout") {
	           $.ajax(this);
	        } 
	    }
	});

});


//GET VENDOR PRODUCTS
// var ajaxCheck = false;
// 	var vendorproduct = $.ajax({
// 	 		type: 'POST',
// 	 		url: '/vendor/products',
// 	 		data: '_token='+token+'&vendor_name='+vendor[0].vendor_url,
// 	 		dataType: "json",
// 	 		timeout: 4000,
// 	 		beforeSend:function(){
// 	 			if(ajaxCheck == false){
// 	 				$('.products-details').append('<ul class="spinner"><li></li><li></li><li></li><li></li><li></li></ul>');
// 	 			}
// 	 			ajaxCheck = true;
// 	 		},
// 	 		success:function(response){
// 	 			$('.products-details .spinner').hide();
// 	 			$('.products-details').hide().append(response).fadeIn("slow");

// 	 			if($(window).height() > 590){
// 	 				if($("#category-sticky").height() < 622){
// 		 				$("#category-sticky").sticky({topSpacing:-10,bottomSpacing:120, getWidthFrom: '#category-menu' });
// 		 			}
// 		 		}
// 	 			vendorproduct.abort();
// 	 		},
// 	 		error: function(jqXHR, textStatus, errorThrown) {
// 		        if(textStatus==="timeout") {
// 		           $.ajax(this);
// 		        } 
// 		    }
// 	});


if($(window).height() > 590){
	if($("#category-sticky").height() < 622){
		$("#category-sticky").sticky({topSpacing:-10,bottomSpacing:120, getWidthFrom: '#category-menu' });
	}
}

$('.menu-head').on('click', function () {
	$(this).children('.fa').toggleClass('fa-plus-circle');
	$(this).children('.fa').toggleClass('fa-minus-circle');
});

</script>
@stop