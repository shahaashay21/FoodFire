@extends('layout')

@section('title')
FoodFire Search - Food Delivery Anand | Order Food Online | Home Delivery Food | Online Food Delivery
@stop

@section('metadesc')
<meta name="description" content="Search FoodFire - Food Delivery in Anand, Food Order, Online Food Ordering Anand, Free Home Delivery, Office Delivery. FoodFire is one of the first online food ordering and delivery platforms in Anand to bring food from your favourite restaurant to your doorstep." />
@stop

@section('keywords')
<meta name="keywords" content="FoodFire, Search Online Food Order Anand, Search Online Order, Search Online Restaurants Anand" />
@stop

@section('content')
<!-- SPACE FOR MOBILE DEVICE -->
<div class="col-xs-12 visible-xs" style="height:45px"></div>

<!-- TOP TOGGLE INSTANT SEARCH BOX -->
<div class="container-fluid search-slide" style="display:none; position:absolute; z-index:99; left:0; right:0; background:white; padding-top:15px;">
	<div class="row">
		<form method="get" action="search" name="search">
			<div class="col-lg-3 col-md-2 col-sm-1 hidden-xs"></div>

			<div class="col-lg-3 col-md-4 col-sm-5 hidden-xs">
				<input id="search1" onkeyup="searchBox(this.value)" class="search_input_text1" type="text" placeholder="Search by Restaurant or Food." name="q">
			</div>
			<div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">
				<input class="search-btn" style="margin-left:50px;" type="submit" value="Find Your Food">
			</div>
			<div class="col-lg-1 col-md-1 col-sm-2 hidden-xs">
				<a class="view-all" style="float:left; font-weight:bold; line-height:18px" href="search?q=">View All<br> Restaurants</a>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-1 hidden-xs"></div>

			<!-- FOR MOBILE -->
			<div class="visible-xs col-xs-5" style="padding-left:10px; padding-right:0px; margin-top:40px">
				<input id="search2" onkeyup="searchBox(this.value)" class="search_input_text1-mob" type="text" placeholder="Search by Restaurant" name="q">
			</div>	
			<div class="visible-xs col-xs-3" style="margin-top:40px">
				<center>
					<input class="search-btn-mob" type="submit" value="Search">
				</center>
			</div>
			<div class="visible-xs col-xs-4" style="margin-top:40px">
				<a class="view-all" style="float:left; font-weight:bold;" href="search?q=">View All<br> Restaurants</a>
			</div>
		
		</form>	
	</div>	
</div>


 <!-- HEADER -- SEARCH AND SEARCH VALUE -->
<div class="container-fluid ff-head">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<i class="fa fa-search"></i> Search - {{ $search }}
	</div>
	<div class="col-lg-2"></div>
</div>


<!-- FILTER BOX --- SORTINGS BOX --- SEARCH RESULT --- RECENT ACTIVITY -->
<div class="container-fluid">
	<div class="rw">

		<!-- RECENT ACTIVITY -->
		<div class="col-lg-2 col-md-2 hidden-xs hidden-sm" id="checkforxs" style="margin-top: 30px; background-color: #fff">
			<h1 style="font-size: 16px">
				<i class="fa fa-diamond" style="color:#db2e2e"></i><b> RECENT</b> ACTIVITY
			</h1>
			<hr style="margin-left: 0px; margin-top: 5px; width: 30%; "><hr style="margin: 19px 0px 0px">

			<div class="continer-fluid recent-activity-content" style="clear:both">
				
				@foreach ($recentactivity as $ra)
					<?php $time = ""; ?>
					@if($ra->diff < 5)
						<?php $time = "a second"; ?>
					@elseif($ra->diff >= 5 && $ra->diff < 60)
						<?php $time = $ra->diff." seconds"; ?>
					@elseif($ra->diff >= 60 && $ra->diff < 120)
						<?php $time = "a minute"; ?>
					@elseif($ra->diff >= 120 && $ra->diff < 3600)
						<?php $time = round(($ra->diff)/60)." minutes"; ?>
					@elseif($ra->diff >= 3600 && $ra->diff < 7200)
						<?php $time = "a hour"; ?>
					@elseif($ra->diff >= 7200 && $ra->diff < 86400)
						<?php $time = round(($ra->diff)/3600)." hours"; ?>
					@elseif($ra->diff >= 86400 && $ra->diff < 172800)
						<?php $time = 'a day'; ?>
					@elseif($ra->diff >= 172800 && $ra->diff < 2592000)
						<?php $time = round(($ra->diff)/86400)." days"; ?>
					@endif

				<div class="container-fluid" style="border-bottom: 2px solid #d2d2d2; padding-bottom: 10px; padding-top: 10px">
					<div class="row">
						<div class="col-lg-4" style="padding:0;">
							<!-- <div class="outer-round">
								<div class="inner-round" style="{{ $ra->dp }}">
									
								</div>	
							</div> -->
							<div class="img-circle outer-round">
								<img class="img-circle inner-round" src="{{ URL::asset($ra->imgsrc) }}">
							</div>
						</div>
						<div class="col-lg-8" style="padding:0">
							{{ ucwords($ra->cusname) }} just viewed <a href="/vendor{{ strtolower($ra->city) }}/{{ strtolower($ra->vendor_url) }}" style="color: #db2e2e; cursor:pointer">{{ ucwords($ra->vendor_name) }}</a> vendor
							<br> <span style="font-size:10px">about {{ $time }} ago</span>
						</div>
					</div>
				</div>

				@endforeach

				
				
			</div>
		</div>
		

		<!-- SORTINGS BOX -->
		<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
			<div class="row">
				<div class="col-lg-10 col-xs-8">
					<div class="btn-group btn-group-justified" role="group">
						<div class="btn-group" role="group">
							<button onclick="filt('vendor_name','alpha')" type="button" class="btn filter-effect btn-edit btn-default-edit">Name</button>
						</div>
						<div class="btn-group" role="group">
							<button onclick="filt('price','num')" type="button" class="btn filter-effect btn-edit btn-default-edit">Price</button>
						</div>
						<div class="btn-group" role="group">
							<button onclick="filt('ratings','num')" type="button" class="btn filter-effect btn-edit btn-default-edit">Rating</button>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-xs-4">
					<button type="button" style="float:right" class="togg-search btn-edit btn-default-edit"><i style="margin-right:5px" class="fa fa-search"></i>Search</button>
				</div>

				
				<!-- SEARCH RESULTS -->
				<div class="col-lg-12 col-xs-12">
					<!-- <br><br> -->
					<div id="seller">
					
					@if($vendors == 'NOTHING')
						<div>There is nothing as per search</div>
					@else						
					@foreach($vendors as $da)
					
						<?php $ratingclass = ''; ?>
						@if($da->born <= 31)
							<?php $ratingclass = 'new'; ?>
						@endif
						@if($da->ratings >= 4.7)
							<?php $ratingclass = 'award';
								  $btn = 'btn-yellow';
							?>
						@else
							<?php 
								  $btn = '';
							?>
						@endif

						<!-- FOR RATINGS -->
						@if( $da->ratings >= 4.5)
							<?php $rat = 'Awesome';
								  $backcolor = '#78c928';
								  $border = '#60a533';
							?>
						@elseif($da->ratings < 4.5 && $da->ratings >= 3.5)
							<?php $rat = 'Good';
								  $backcolor = '#3498db';
								  $border = '#2980b9';
							 ?>
						@elseif($da->ratings < 3.5 && $da->ratings >= 2.5)
							<?php $rat = 'Average';
								  $backcolor = '#f1c40f';
								  $border = '#f39c12';
							 ?>
						@elseif($da->ratings < 2.5 && $da->ratings >= 1.5)
							<?php $rat = 'Poor';
								  $backcolor = '#e67e22';
								  $border = '#d35400';
							 ?>
						@elseif($da->ratings < 1.5)
							<?php $rat = 'Bad';
								  $backcolor = '#e74c3c';
								  $border = '#c0392b';
							 ?>
						@endif

						<div class='cat-box col-lg-12'>
							<!-- <div class='category-fill-round'>
								<div class='category-item-desc' style="{{ $da->dp }}"></div>
							</div> -->
							<div class='img-circle avatarex'>
								<img class='img-circle category-item-descex' height="100%" width="100%" src="{{ URL::asset($da->imgsrc) }}">
							</div>
							<article>
								<div class='ribbon {{ $ratingclass }} '></div>
								<div id='ff-sel-love'>
									<span onclick="updatevalue({{ $da->vendorunkid }},'1','1')" class='btn btn-default btn-sm' title='Like' data-placement='top' data-toggle='tooltip'>
										<i class='fa fa-thumbs-up fa-white like-ico-{{ $da->vendorunkid }}'></i>
										<span id='vendor-like-{{ $da->vendorunkid }}'>{{ $da->likes }}</span>
									</span>
									<span onclick="updatevalue({{ $da->vendorunkid }},'3','1')" class='btn btn-default btn-sm' title='Favourite' data-placement='top' data-toggle='tooltip'>
										<i class='fa fa-star fa-white favourite-ico-{{ $da->vendorunkid }}'></i> 
										<span id='vendor-favourite-{{ $da->vendorunkid }}'>{{ $da->favourite }}</span>
									</span>
									<span onclick="updatevalue({{ $da->vendorunkid }},'4','1')" class='btn btn-default btn-sm' title='Visit' data-placement='top' data-toggle='tooltip'>
										<i class='fa fa-map-marker fa-lg visit-ico-{{ $da->vendorunkid }}'></i>
										<span id='vendor-visit-{{ $da->vendorunkid }}'>{{ $da->visit }}</span>
									</span>
								</div>


								<!-- <a href='{{ Request::root() }}/vendor/{{ strtolower($da->city) }}/{{ strtolower($da->vendor_url) }}' class='btn-red order-btn {{ $btn }}'>Order Now</a> -->
								<a href='vendor/{{ strtolower($da->city) }}/{{ strtolower($da->vendor_url) }}' class='btn-red order-btn {{ $btn }}'>Order Now</a>
								<!-- <h6>{{ ucwords($da->vendor_name) }}</h6> -->
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-8 col-md-8 col-sm-7">
											<h6>{{ ucwords($da->vendor_name) }}</h6>
									
											<ul class='rate stars hidden-xs' data-toggle='tooltip' title='Ratings' data-placement='top'>
												@for ($j=0; $j<5; $j++)
													@if($da->ratings > $j)
														<li></li>
													@else
														<li class='empty'></li>
													@endif
												@endfor
											</ul>
										</div>
										@if($ratingclass == '')
										<div class="col-lg-4 col-md-4 col-sm-5 hidden-xs" style="padding: 0px">
											<div class="btn btn-default" style="float:right; padding:0 0 0 10px; min-height: 38px; border-width:1px 1px 3px; max-width:100%; overflow: hidden">
												
												@if( $da->votes == 0)
													<span style="float:left; margin-right:5px; margin-top: 5px">
														<span style="font-weight:bold; font-size:15px;">No Ratings Yet</span>
													</span>
												@else
													<span style="float:left; margin-right:5px">
														<span style="font-weight:bold; font-size:15px">{{ $rat }}</span>
														<span style="font-size:9px; display:block">{{ $da->votes }} User Votes</span>
													</span>
													<span class="btn btn-green" style="background:{{ $backcolor }} ;border-bottom:solid {{ $border }}; font-size:18px; padding: 4px 7px">{{ $da->ratings }}</span>
												@endif
												
											</div>
										</div>
										@endif
										
									</div>
								</div>
								<!-- MOBILE DEVICES -->
								<div class='sell-details mob visible-xs' style='width:64%'>
									<ul class='rate stars' style="display:inline-block; margin-right:20px" data-toggle='tooltip' title='Ratings' data-placement='top'>
										@for ($j=0; $j<5; $j++)
											@if($da->ratings > $j)
												<li></li>
											@else
												<li class='empty'></li>
											@endif
										@endfor
									</ul>
									<div class="btn btn-default" style="padding:0 0 0 10px; min-height: 38px; border-width:1px 1px 3px;">
										
										@if( $da->votes == 0)
											<span style="float:left; margin-right:5px; margin-top: 5px">
												<span style="font-weight:bold; font-size:15px;">No Ratings Yet</span>
											</span>
										@else
											<span style="float:left; margin-right:5px">
												<span style="font-weight:bold; font-size:15px">{{ $rat }}</span>
												<span style="font-size:9px; display:block">{{ $da->votes }} User Votes</span>
											</span>
											<span class="btn btn-green" style="background:{{ $backcolor }} ;border-bottom:solid {{ $border }}; font-size:18px; padding: 4px 7px">{{ $da->ratings }}</span>
										@endif
										
									</div>
								</div>
								<!-- END MOBILE DEVICES -->

								<br>
								<div class='sell-details mob' style='margin-bottom: 8px; width:64%'>
									<div style='display: inline-table'><i class='tooli fa fa-map-marker fa-lg' data-toggle='tooltip' title='Area Location' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($da->area) }}, {{ ucwords($da->city) }}</span></div>
									<div style='display: inline-table'><i class='tooli fa fa-clock-o fa-lg' data-toggle='tooltip' data-placement='top' title='Average Cooking Time'></i><span style='font-color: #a0a0a0; margin-left: 5px; font-size:13px'>{{ ucwords($da->del_time) }} Minutes</span></div>
								</div>
								<div class='sell-details mob' style='line-height: 25px'>
									@if($da->speciality != null || $da->speciality != '')
										<div style='display: inline-table'><i class='fa fa-asterisk fa-lg' data-toggle='tooltip' title='Speciality' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>{{ ucwords($da->speciality) }}</span></div>
									@endif
										<div style='display: inline-table'>
										
										@if($da->veg == 1 || $da->jain == 1 || $da->swaminarayan == 1 || $da->non_veg == 1)
											<i class='fa fa-cutlery fa-lg' style='margin-right: 5px;' data-toggle='tooltip' title='Food Diet' data-placement='top'></i>
										@endif
										@if($da->veg == 1)
											<img src='public/images/vegetarian-20x20.png' data-toggle='tooltip' title='Vegetarian' data-placement='top' class='img-responsive'>
										@endif
										@if($da->jain == 1)
											<img src='public/images/jain-20x20.png' data-toggle='tooltip' title='Jain' data-placement='top' class='img-responsive'>
										@endif
										@if($da->swaminarayan == 1)
											<img src='public/images/swaminarayan-20x20.png' data-toggle='tooltip' title='Swaminarayan' data-placement='top' class='img-responsive'>
										@endif
										@if($da->non_veg == 1)
											<img src='public/images/non-vegetarian-20x20.png' data-toggle='tooltip' title='Non Vegetarian' data-placement='top' class='img-responsive'>
										@endif

										</div>
									
									 <span style='margin-left: 9px; display: inline-table' title='Price Range' data-placement='top' data-toggle='tooltip'>
										
										@for($j=0; $j<5; $j++)
											@if($da->price > $j)
												<i class='fa fa-inr fa-lg'></i>
											@endif
										@endfor
									</span>
								</div>
							</article>
						</div>


					@endforeach

					@endif	





							
					</div>
				</div>	
			</div>
		</div>

		<!-- FILTER BOX -->
		<div class="col-lg-3 col-md-3 col-sm-4 hidden-xs" style="margin-top: 30px; background-color: #fff">
			<div id="wrap-sticky" style="padding-top:5px">
				
			</div>


			<!-- <h1 style="font-size: 16px">
				<i class="fa fa-fighter-jet" style='color:#db2e2e'></i><b> CATEGORIES</b>
			</h1>
			<hr style="margin-left: 0px; margin-top: 5px; width: 30%; "><hr style="margin: 19px 0px 0px">

			<div class="cat-menu">
				<h3 class="type">Types</h3>
				<div id="myPopover" class="myPopover1" style="width:200px">
					<div class="set" style="position:absolute; left:-7px"><span class="aero"><i class="fa fa-caret-left fa-2x"></i></span></div>
					This is a popover list:
					<ul>
						<li>List item 1</li>
						<li>List item 2</li>
						<li>List item 3</li>
						<li>List item 4</li>
						<li>List item 5</li>
						<li>List item 6</li>
						<li>List item 7</li>
					</ul>
				</div>
				<h3 class="cuisines">Cuisines</h3>
				<div id="myPopover" class="myPopover2" style="width:200px">
					<div class="set" style="position:absolute; left:-7px"><span class="aero"><i class="fa fa-caret-left fa-2x"></i></span></div>
					This is a popover list:
					<ul>
						<li>List item 1</li>
						<li>List item 2</li>
						<li>List item 3</li>
						<li>List item 4</li>
						<li>List item 5</li>
					</ul>
				</div>
				<h3 class="fooddiets">Food Diets</h3>
				<div id="myPopover" class="myPopover3" style="width:200px">
					<div class="set" style="position:absolute; left:-7px"><span class="aero"><i class="fa fa-caret-left fa-2x"></i></span></div>
					This is a popover list:
					<ul>
						<li>List item 1</li>
						<li>List item 2</li>
						<li>List item 3</li>
					</ul>
				</div>
				<h3 class="areas">Areas</h3>
				<div id="myPopover" class="myPopover4" style="width:200px">
					<div class="set" style="position:absolute; left:-7px"><span class="aero"><i class="fa fa-caret-left fa-2x"></i></span></div>
					This is a popover list:
					<ul>
						<li>List item 1</li>
				</div>
				<h3 class="price">Price</h3>
				<div id="myPopover" class="myPopover5" style="width:200px">
					<div class="set" style="position:absolute; left:-7px"><span class="aero"><i class="fa fa-caret-left fa-2x"></i></span></div>
					This is a popover list:
					<ul>
						<li>List item 1</li>
						<li>List item 2</li>
						<li>List item 3</li>
						<li>List item 4</li>
						<li>List item 5</li>
						<li>List item 6</li>
						<li>List item 7</li>
					</ul>
				</div>
			</div> -->
		</div>

	</div>
</div>















<!-- <img src='public/images/U_S_Pizza.png' class='category-item-desc' alt='"+toTitleCase(x[i].vendor_name)+"'> \ -->
@stop

@section('javascr')

<script type="text/javascript">

$('body').css('background','#fafafa');
// $('body').css('background','#f3f3f3');

//START SEARCH RESULTS
	var sellerdata = <?php echo $data;  ?>;
	// var q = <?php echo $search; ?>;
	// console.log('VALUE '+sellerdata[0].vendor_name);
	// var arr = Object.keys(a[0]).map(function(k) { return a[0][k] });
	// console.log('here is '+sellerdata);

	// IF THERE IS DATA THEN RENDER IT OTHERWISE NO SEARCH RESULTS
	if(sellerdata != "NOTHING"){
		// console.log('somethin');
		//filt('vendor_name','alpha');
		
	}else{
		document.getElementById("seller").innerHTML = "There is nothing as per search";
	}

	//USING AJAX CALL --- GET VENDOR DATA  ---- AASHAY SHAH 19 JUN 2015  ----
	// $(document).ready(function(){
		
	// 	$.ajax({
	//  		type: 'POST',
	//  		url: 'vendor_details',
	//  		data: 'limit=10&_token='+token+'&q='+q,
	//  		dataType: "json",
	//  		cache: false,
	//  		success:function(response){
	//  			console.log(response);
	//  			render(response);
	//  		}
	//  	});
	// });


	// FILTERING AS PER FUNCTION INPUT(COLUMN) VALUE
	function filt(val, vari){
		// console.log(val);
		function sortByKey(array, key) {
		    if(vari=='alpha'){
			    return array.sort(function(a, b) {
			        var x = a[key].toLowerCase(); var y = b[key].toLowerCase();
			        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
			    });
			}else if(vari == 'num'){
				if(val == 'ratings')
				{
					return array.sort(function(a, b) {
						if(a[key] == null){
							a[key] = 0;
						}
						if(b[key] == null){
							b[key] = 0;
						}
				        var x = a[key]; var y = b[key];
				        return y-x;
				    });
				}
			    else{
			    	return array.sort(function(a, b) {
				        var x = a[key]; var y = b[key];
				        return x-y;
				    });
			    }
				
			}
		}
		var x = sortByKey(sellerdata, val);
		render(x);
		return;
	}

	// INSTANT SEARCH BOX VALUE
	function searchBox(sea){
		var re = new RegExp("^"+sea+".*","i"); 
		function searchCheck(){
			var reans = [];
			for(var i=0; i<sellerdata.length; i++){
				if(sellerdata[i].vendor_name.match(re)){
					reans.push(sellerdata[i]);
				}
			}
			return reans;
		}
		var x = searchCheck();
		render(x);
	}


	//REDER PAGE AS PER DATA
	function render(x){
		var data = "";
		
		for(var i=0; i<x.length; i++){
			// data += "<div style='margin-bottom:10px; text-align: left;'><p>"+toTitleCase(x[i].vendor_name)+"</p><p>"+toTitleCase(x[i].area)+", "+toTitleCase(x[i].city)+"</p></div>\n";

			data += "<div class='cat-box col-lg-12'> \
							\
							<div class='img-circle avatarex'> \
								<img class='img-circle category-item-descex' height='100%' width='100%' src='http://www.foodfire.net/"+x[i].imgsrc+"'> \
							</div> \
							<article> \
								<div class='ribbon ";
								if(x[i].ratings >= 4.7){
									data += "award";
								}else if(x[i].born <= 31){
									data += "new";
								}
								
			data += "'></div> \
								<div id='ff-sel-love'> \
									<span onclick=\"updatevalue('"+x[i].vendorunkid+"','1','1')\" class='btn btn-default btn-sm' title='Like' data-placement='top' data-toggle='tooltip'> \
										<i class='fa fa-thumbs-up fa-white like-ico-"+x[i].vendorunkid+"'></i> \
										<span id='vendor-like-"+x[i].vendorunkid+"'>"+x[i].likes+"</span> \
									</span> \
									<span onclick=\"updatevalue('"+x[i].vendorunkid+"','3','1')\" class='btn btn-default btn-sm' title='Favourite' data-placement='top' data-toggle='tooltip'> \
										<i class='fa fa-star fa-white favourite-ico-"+x[i].vendorunkid+"'></i> \
										<span id='vendor-favourite-"+x[i].vendorunkid+"'>"+x[i].favourite+"</span> \
									</span> \
									<span onclick=\"updatevalue('"+x[i].vendorunkid+"','4','1')\" class='btn btn-default btn-sm' title='Visit' data-placement='top' data-toggle='tooltip'> \
										<i class='fa fa-map-marker fa-lg visit-ico-"+x[i].vendorunkid+"'></i> \
										<span id='vendor-visit-"+x[i].vendorunkid+"'>"+x[i].visit+"</span> \
									</span> \
								</div> \
								<a href='vendor/"+x[i].city.toLowerCase()+"/"+x[i].vendor_url.toLowerCase()+"' class='btn-red order-btn ";
								if(x[i].ratings >= 4.7){
									data += "btn-yellow";
								}
			data += "'>Order Now</a>";

								if( x[i].ratings >= 4.5){
									var rat = 'Awesome';
									var backcolor = '#78c928';
									var border = '#60a533';
								}
								else if(x[i].ratings < 4.5 && x[i].ratings >= 3.5){
									var rat = 'Good';
									var backcolor = '#3498db';
									var border = '#2980b9';
								}
								else if(x[i].ratings < 3.5 && x[i].ratings >= 2.5){
									var rat = 'Average';
									var backcolor = '#f1c40f';
									var border = '#f39c12';
								}
								else if(x[i].ratings < 2.5 && x[i].ratings >= 1.5){
									var rat = 'Poor';
									var backcolor = '#e67e22';
									var border = '#d35400';
								}
								else if(x[i].ratings < 1.5){
									var rat = 'Bad';
									var backcolor = '#e74c3c';
									var border = '#c0392b';
								}


			data +=" <div class='container-fluid'> \
									<div class='row'> \
										<div class='col-lg-8 col-md-8 col-sm-7'> \
											<h6>"+toTitleCase(x[i].vendor_name)+"</h6> \
											\
											<ul class='rate stars hidden-xs' data-toggle='tooltip' title='Ratings' data-placement='top'> ";
												for(j=0; j<5; j++){
													if(x[i].ratings > j){
														data += "<li></li>";
													}else{
														data += "<li class='empty'></li>";
													}
												}
			data += " </ul> \
										</div> ";
										if(x[i].ratings < 4.7 && x[i].born > 31){
			data += " <div class='col-lg-4 col-md-4 col-sm-5 hidden-xs' style='padding: 0px'> \
											<div class='btn btn-default' style='float:right; min-height:38px; padding:0 0 0 10px; border-width:1px 1px 3px; max-width:100%; overflow: hidden'>";
												if(x[i].votes == 0){
			data += "<span style='float:left; margin-right:5px; margin-top:5px'> \
													<span style='font-weight:bold; font-size:15px'>No Ratings Yet</span> \
												</span>";
												}else{										
			data += "<span style='float:left; margin-right:5px'> \
													<span style='font-weight:bold; font-size:15px'>"+ rat +"</span> \
													<span style='font-size:9px; display:block'>"+ x[i].votes +" User Votes</span> \
												</span> \
												<span class='btn btn-green' style='background:"+ backcolor +" ;border-bottom:solid "+ border +"; font-size:18px; padding: 4px 7px'>"+ x[i].ratings +"</span>";
												}
			data += "</div> \
										</div>";
										}
										
			data +=	" </div> \
								</div>";

			data +=	"				<div class='sell-details mob visible-xs' style='width:64%'> \
									<ul class='rate stars' style='display:inline-block; margin-right:20px' data-toggle='tooltip' title='Ratings' data-placement='top'>";
										for(j=0; j<5; j++){
													if(x[i].ratings > j){
														data += "<li></li>";
													}else{
														data += "<li class='empty'></li>";
													}
												}
			data += " </ul> \
									<div class='btn btn-default' style='padding:0 0 0 10px; min-height: 38px; border-width:1px 1px 3px;'>";
										if( x[i].votes == 0){
			data +=" <span style='float:left; margin-right:5px; margin-top: 5px'> \
												<span style='font-weight:bold; font-size:15px;'>No Ratings Yet</span> \
											</span>";
										}else{
			data +="								<span style='float:left; margin-right:5px'> \
												<span style='font-weight:bold; font-size:15px'>"+rat+"</span> \
												<span style='font-size:9px; display:block'>"+x[i].votes+" User Votes</span> \
											</span> \
											<span class='btn btn-green' style='background:"+ backcolor +" ;border-bottom:solid "+ border +"; font-size:18px; padding: 4px 7px'>"+ x[i].ratings +"</span>";
										}
			data += " </div> \
								</div>";

			data += "<br> \
								<div class='sell-details mob' style='margin-bottom: 8px; width:64%'> \
									<div style='display: inline-table'><i class='tooli fa fa-map-marker fa-lg' data-toggle='tooltip' title='Area Location' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>"+toTitleCase(x[i].area)+", "+toTitleCase(x[i].city)+"</span></div> \
									<div style='display: inline-table'><i class='tooli fa fa-clock-o fa-lg' data-toggle='tooltip' data-placement='top' title='Average Cooking Time'></i><span style='font-color: #a0a0a0; margin-left: 5px; font-size:13px'>"+toTitleCase(x[i].del_time)+" Minutes</span></div> \
								</div> \
								<div class='sell-details mob' style='line-height: 25px'>";
									// console.log(x[i].speciality);
									if(x[i].speciality){
										data += "<div style='display: inline-table'><i class='fa fa-asterisk fa-lg' data-toggle='tooltip' title='Speciality' data-placement='top'></i><span style='font-color: #a0a0a0; margin: 0 9px 0 5px; font-size:13px'>"+toTitleCase(x[i].speciality)+"</span></div>";
									}
									data += "<div style='display: inline-table'>";
										
										if(x[i].veg == 1 || x[i].jain == 1 || x[i].swaminarayan == 1 || x[i].non_veg == 1){
											data += "<i class='fa fa-cutlery fa-lg' style='margin-right: 5px;' data-toggle='tooltip' title='Food Diet' data-placement='top'></i> ";
										}
										if(x[i].veg == 1){
											data += "<img src='public/images/vegetarian-20x20.png' data-toggle='tooltip' title='Vegetarian' data-placement='top' class='img-responsive'>";
										}
										if(x[i].jain == 1){
											data += "<img src='public/images/jain-20x20.png' data-toggle='tooltip' title='Jain' data-placement='top' class='img-responsive'>";
										}
										if(x[i].swaminarayan == 1){
											data += "<img src='public/images/swaminarayan-20x20.png' data-toggle='tooltip' title='Swaminarayan' data-placement='top' class='img-responsive'>";
										}if(x[i].non_veg == 1){
											data += "<img src='public/images/non-vegetarian-20x20.png' data-toggle='tooltip' title='Non Vegetarian' data-placement='top' class='img-responsive'>";
										}
										
			data +=	"</div> \
									 <span style='margin-left: 9px; display: inline-table' title='Price Range' data-placement='top' data-toggle='tooltip'> ";
										
										for(j=0; j<5; j++){
											if(x[i].price > j){
												data += "<i class='fa fa-inr fa-lg'></i>";
											}
										}
										
			data += "</span> \
								</div> \
							</article> \
						</div>";
		}
		// data = '<h6>Aashay</h6>'
		// document.getElementById("seller").innerHTML = data;
		$("#seller").html(data);
		// return;
	}

	function toTitleCase(str)
	{
	    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	}

//END SEARCH RESULTS


//START SERVER SIDE EVENTS FOR RECENT ACTIVITY
var xsvalue = $('#checkforxs').css('display');
if(xsvalue != 'none'){

	if(typeof(EventSource) !== "undefined") {
	     var source = new EventSource("recentactivity");
	     source.onmessage = function(event) {
	     	var d = JSON.parse(event.data);
	    // //     // document.getElementById("result").innerHTML += d[0].diff + "<br>";
	        recentActivity(d);
	    };
	} else {
	    // document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
	}

	function recentActivity(data){
		var radata = "";
		for(var x=0; x<data.length; x++){
			var time;
			if(data[x].diff < 5){
				time = "a second";
			}else if(data[x].diff >= 5 && data[x].diff < 60){
				time = data[x].diff+" seconds";
			}else if(data[x].diff >= 60 && data[x].diff < 120){
				time = "a minute";
			}else if(data[x].diff >= 120 && data[x].diff < 3600){
				time = Math.round((data[x].diff)/60)+" minutes";
			}else if(data[x].diff >= 3600 && data[x].diff < 7200){
				time = "a hour";
			}else if(data[x].diff >= 7200 && data[x].diff < 86400){
				time = Math.round((data[x].diff)/3600)+" hours";
			}else if(data[x].diff >= 86400 && data[x].diff < 172800){
				time = 'a day';
			}
			else if(data[x].diff >= 172800 && data[x].diff < 2592000){
				time = Math.round((data[x].diff)/86400)+" days";
			}
			radata += "<div class='container-fluid' style='border-bottom: 2px solid #d2d2d2; padding-bottom: 10px; padding-top: 10px'>\
						<div class='row'>\
							<div class='col-lg-4' style='padding:0;'>\
								<div class='img-circle outer-round'>\
									<img class='img-circle inner-round' src='http://www.foodfire.net/"+data[x].imgsrc+"'>\
								</div>\
							</div>\
							<div class='col-lg-8' style='padding:0'>\
								"+toTitleCase(data[x].cusname)+" just viewed <a href='vendor/"+data[x].city.toLowerCase()+"/"+data[x].vendor_url.toLowerCase()+"' style='color: #db2e2e; cursor:pointer'>"+toTitleCase(data[x].vendor_name)+"</a> vendor\
								<br> <span style='font-size:10px'>about "+time+" ago</span>\
							</div>\
						</div>\
					</div>";
			$(".recent-activity-content").html(radata);
		}
	}
}
//END SERVER SIDE EVENTS FOR RECENT ACTIVITY




// START LEFT SIDE CATEGORIES HOVER EFFECT
var he = $('.myPopover1').height();
$('.myPopover1 .aero').css('top',(he/2)-15+'px');
$('.myPopover1 .set').css('height',he+'px');
$('.myPopover1').css('top',103-(he/2)+'px');

$(".type").hover(function() {
	$(".myPopover1").toggle();
	$('.type').toggleClass('typeeffect');
});
$(".myPopover1").hover(function() {
	$(".myPopover1").toggle();
	$('.type').toggleClass('typeeffect');
});


var he = $('.myPopover2').height();
$('.myPopover2 .aero').css('top',(he/2)-15+'px');
$('.myPopover2 .set').css('height',he+'px');
$('.myPopover2').css('top',147-(he/2)+'px');

$(".cuisines").hover(function() {
	$(".myPopover2").toggle();
	$('.cuisines').toggleClass('cuisineseffect');
});
$(".myPopover2").hover(function() {
	$(".myPopover2").toggle();
	$('.cuisines').toggleClass('cuisineseffect');
});

var he = $('.myPopover3').height();
$('.myPopover3 .aero').css('top',(he/2)-15+'px');
$('.myPopover3 .set').css('height',he+'px');
$('.myPopover3').css('top',191-(he/2)+'px');

$(".fooddiets").hover(function() {
	$(".myPopover3").toggle();
	$('.fooddiets').toggleClass('fooddietseffect');
});
$(".myPopover3").hover(function() {
	$(".myPopover3").toggle();
	$('.fooddiets').toggleClass('fooddietseffect');
});

var he = $('.myPopover4').height();
$('.myPopover4 .aero').css('top',(he/2)-15+'px');
$('.myPopover4 .set').css('height',he+'px');
$('.myPopover4').css('top',235-(he/2)+'px');

$(".areas").hover(function() {
	$(".myPopover4").toggle();
	$('.areas').toggleClass('areaseffect');
});
$(".myPopover4").hover(function() {
	$(".myPopover4").toggle();
	$('.areas').toggleClass('areaseffect');
});


var he = $('.myPopover5').height();
$('.myPopover5 .aero').css('top',(he/2)-15+'px');
$('.myPopover5 .set').css('height',he+'px');
$('.myPopover5').css('top',279-(he/2)+'px');

$(".price").hover(function() {
	$(".myPopover5").toggle();
	$('.price').toggleClass('priceeffect');
});
$(".myPopover5").hover(function() {
	$(".myPopover5").toggle();
	$('.price').toggleClass('priceeffect');
});

// END LEFT SIDE CATEGORIES HOVER EFFECT
	
	
</script>

@stop