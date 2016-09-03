@extends('homelayout')

@section('title')
FoodFire - Food Delivery Anand | Order Food Online | Home Delivery Food | Online Food Delivery
@stop

@section('metadesc')
<meta name="description" content="FoodFire - Food Delivery in Anand, Food Order, Online Food Ordering Anand, Free Home Delivery, Office Delivery. FoodFire is one of the first online food ordering and delivery platforms in Anand to bring food from your favourite restaurant to your doorstep." />
@stop

@section('keywords')
<meta name="keywords" content="FoodFire, Online Food Order Anand, Free Home Delivery, Online Order, Online Restaurants Anand" />
@stop

@section('content')
<!-- END IT SHOULD BE WRIITEN IN EVERY PAGE.... -->

<!-- FIRST BACK IMAGE AND EFFECTS -->
<div class="container-fluid img-responsive" id="header-bottom-wrap">
	<section id="header-bottom">
		<div class="row">
			<div class="hidden-xs col-lg-12">
				<center><div style="color:#db2e2e">DEMO FOR NOW -- USE SAHYOG RESTAURANT TO ORDER</div></center>
			</div>
			<div class="col-xs-12 visible-xs">
				<center><div style="color:#db2e2e; margin-top:50px;">DEMO FOR NOW -- USE SAHYOG RESTAURANT TO ORDER</div></center>
			</div>
			<!-- <div class="col-lg-6 wow bounceInLeft"> -->
			<div class="col-lg-6 leftt">
				<center>
					<div class="search_frame">
			        	<div class="search_top_boarder" class="search_boarder"></div><!---search_boarder -->
			        	<div class="start_order">Start Your Order</div>
			            <div class="horizontal"></div>
			            
			            {{ Form::open(array('route' => 'search', 'method' => 'get')) }}
			            <input type="text" name="q" id="search" class="form-control search_input_text" style="margin-bottom:20px; font-size:18px" placeholder="Search by Restaurant">
			            <span><input type="submit" class="btn-red" value="Find Your Food" style="height:40px; float:left; padding: 5px 15px; margin-left:15%; font-weight:700"></span>
			            <div>{{ HTML::link('/search', 'View All Restaurants') }}</div>
			            {{ Form::close() }}
			        </div>
		        </center><!---search_frame -->
		    </div>
			<div class="col-lg-4 hidden-md hidden-sm hidden-xs">
				<div class="wow bounceInDown">
				<!-- <img src="public/images/asian-girl.png"> -->
				</div>
			</div>
		</div>
	</section>


	<!-- CAROUSEL -->
	<center>
		<div id="carousel-example-generic" style="width: 730px" class="carousel slide hidden-xs" data-ride="carousel">
		  <!-- Wrapper for slides -->
		  
			<div class="carousel-inner" style="width: 730px; height: 108px;" role="listbox">

			    <div class="item active">
					<div class="gal-wrap">
						<div class="gal-1">
							<div class="gal-circle">
								<div class="gal-inner-circle gal-img-1"></div>
							</div>
							<div class="gal-text">
								<span class="gal-text-span" style="color: #fff"><b>WEEK'S </b><span style="color: #db2e2e"><b>SPECIAL COMBO</b></span></span>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate alias quibusdam suscipit ea non consequuntur fugit hic quia deleniti odit.</p>
							</div>
							<div class="gal-price">
								<h3>RS <b>100</b></h3>
								<span class="price-span" style="float:right">VALID FOR WEEK</span>
								<span style="margin-left:10px" class="set combo-add red">ADD TO CART</span>
							</div>
						</div>
					</div>
			    </div>

			    <div class="item">
					<div class="gal-wrap">
						<div class="gal-1">
							<div class="gal-circle">
								<div class="gal-inner-circle gal-img-2"></div>
							</div>
							<div class="gal-text">
								<span class="gal-text-span" style="color: #fff"><b>WEEK'S </b><span style="color: #db2e2e"><b>SPECIAL COMBO</b></span></span>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate alias quibusdam suscipit ea non consequuntur fugit hic quia deleniti odit.</p>
							</div>
							<div class="gal-price">
								<h3>RS <b>150</b></h3>
								<span class="price-span" style="float:right">VALID FOR WEEK</span>
								<span style="margin-left:10px" class="set combo-add red">ADD TO CART</span>
							</div>
						</div>
					</div>
			    </div>

			    <div class="item">
					<div class="gal-wrap">
						<div class="gal-1">
							<div class="gal-circle">
								<div class="gal-inner-circle gal-img-3"></div>
							</div>
							<div class="gal-text">
								<span class="gal-text-span" style="color: #fff"><b>WEEK'S </b><span style="color: #db2e2e"><b>SPECIAL COMBO</b></span></span>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate alias quibusdam suscipit ea non consequuntur fugit hic quia deleniti odit.</p>
							</div>
							<div class="gal-price">
								<h3>RS <b>200</b></h3>
								<span class="price-span" style="float:right">VALID FOR WEEK</span>
								<span style="margin-left:10px" class="set combo-add red">ADD TO CART</span>
							</div>
						</div>
					</div>
			    </div>

			</div>
		  

		  	<!-- Controls -->
			<a class="left carousel-control" style="background-image: none; opacity: 1.0" href="#carousel-example-generic" role="button" data-slide="prev">
				<div class="gal-left-arrow"></div>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" style="background-image: none; opacity: 1.0" href="#carousel-example-generic" role="button" data-slide="next">
				<div class="gal-right-arrow"></div>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</center>


</div>

<!-- WHITE BACK-IMG ITEM DESC -->
<div class="container xds" id="white-item-desc">
	<div class="row">
		<!-- <div class="col-lg-4 wow bounceInLeft" style="padding-top:50px;"> -->
		<div class="col-lg-4" style="padding-top:50px;">
			<center>
				<div class="fill-round">
					<div class="item-desc item-desc-1">
					</div>
				</div>
				<div class="content-desc-title">SUSHI AND ROLLS</div>
				<div style="color:#a0a0a0; margin-bottom:30px">Lorem ipsum dolor sit amet, consectetur ed<br>adipisicing elit, sed do eiusmod tempor<br>incididuut labore consectetur.</div>
				<button class="btn-red" style="padding:5px 10px;">GO TO SUSHI</button>
			</center>
		</div>
		<!-- <div class="col-lg-4 wow bounceInLeft" style="padding-top:50px;"> -->
		<div class="col-lg-4" style="padding-top:50px;">
			<center>
				<div class="fill-round">
					<div class="item-desc item-desc-2">
					</div>
				</div>
				<div class="content-desc-title">SOUPS AND HOT DISHES</div>
				<div style="color:#a0a0a0; margin-bottom:30px">Lorem ipsum dolor sit amet, consectetur ed<br>adipisicing elit, sed do eiusmod tempor<br>incididuut labore consectetur.</div>
				<button class="btn-red" style="padding:5px 10px;">GO TO SOUPS</button>
			</center>
		</div>
		<!-- <div class="col-lg-4 wow bounceInLeft" style="padding-top:50px; margin-bottom:50px"> -->
		<div class="col-lg-4" style="padding-top:50px; margin-bottom:50px">
			<center>
				<div class="fill-round">
					<div class="item-desc item-desc-3">
					</div>
				</div>
				<div class="content-desc-title">SWEETS AND DESSERTS</div>
				<div style="color:#a0a0a0; margin-bottom:30px">Lorem ipsum dolor sit amet, consectetur ed<br>adipisicing elit, sed do eiusmod tempor<br>incididuut labore consectetur.</div>
				<button class="btn-red" style="padding:5px 10px;">GO TO DESSERTS</button>
			</center>
		</div>
	</div>
</div>

<!-- FOOD APPETIZERS -->
<div class="container-fluid img-responsive" id="black-img">
	<div class="col-xs-12" style="margin-top: 50px; margin-bottom:80px">
		<center><img style="margin-bottom:30px" src="public/images/recipe-icon.png" class="img-responsive"></center>
		<center><h1 style="color:#FFF; margin-top:-2px"><b>EXPERIENCE THE BEST FOOD</b></h1></center>
		<center><h3 style="color:#888; margin-top:-5px"><b>OUR FEATURE RECIPES</b></h3></center>
	</div>

	<!-- START FOOD ITEMS DIFFERENT AS PER WIDTH -->
	<div class="col-lg-12 visible-lg recipes">
		<center>
			<ul class="list-inline">
				<li class="recipe-round"><div class="recipe-inner-round recipe-round1"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round2"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round4"></div></li>
				<li class="recipe-round recipe-round-active"><div class="recipe-inner-round recipe-round3"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round6"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round5"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round7"></div></li>
			</ul>
		</center>
	</div>

	<div class="col-md-12 visible-md recipes">
		<center>
			<ul class="list-inline">
				<li class="recipe-round"><div class="recipe-inner-round recipe-round1"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round2"></div></li>
				<li class="recipe-round recipe-round-active"><div class="recipe-inner-round recipe-round3"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round6"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round5"></div></li>
			</ul>
		</center>
	</div>

	<div class="col-sm-12 visible-sm recipes">
		<center>
			<ul class="list-inline">
				<li class="recipe-round"><div class="recipe-inner-round recipe-round1"></div></li>
				<li class="recipe-round recipe-round-active"><div class="recipe-inner-round recipe-round3"></div></li>
				<li class="recipe-round"><div class="recipe-inner-round recipe-round5"></div></li>
			</ul>
		</center>
	</div>

	<div class="col-xs-12 visible-xs recipes">
		<center>
			<ul class="list-inline">
				<li class="recipe-round recipe-round-active"><div class="recipe-inner-round recipe-round3"></div></li>
			</ul>
		</center>
	</div>
	<!-- END -->

	<div class="col-lg-3 col-md-3 col-sm-2">
	</div>
	<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
		
		<center>
		<div style="display:none" class="text1">
			<h3 style="color: #db2e2e"><i>Punjabi</i></h3>
			<p style="color: #888; margin-bottom: 20px;"><i>Perhaps Britain's least appetisingly-named meal, this dish of sausages in Yorkshire pudding batter is said to have gained its unusual moniker because it looks like toads popping their heads from a hole
			</i></p>
			<a class="btn red-btn" href="{{ URL::route('search') }}" role="button">Find Restaurants</a>
		</div>

		<div style="display:none" class="text2">
			<h3 style="color: #db2e2e"><i>Cake</i></h3>
			<p style="color: #888; margin-bottom: 20px;"><i>Perhaps Britain's least appetisingly-named meal, this dish of sausages in Yorkshire pudding batter is said to have gained its unusual moniker because it looks like toads popping their heads from a hole
			</i></p>
			<a class="btn red-btn" href="{{ URL::route('search') }}" role="button">Find Restaurants</a>
		</div>

		<div style="display:none" class="text3">
			<h3 style="color: #db2e2e"><i>Pizza</i></h3>
			<p style="color: #888; margin-bottom: 20px;"><i>Perhaps Britain's least appetisingly-named meal, this dish of sausages in Yorkshire pudding batter is said to have gained its unusual moniker because it looks like toads popping their heads from a hole
			</i></p>
			<a class="btn red-btn" href="{{ URL::route('search') }}" role="button">Find Restaurants</a>
		</div>

		<div class="text4">
			<h3 style="color: #db2e2e"><i>Snacks</i></h3>
			<p style="color: #888; margin-bottom: 20px;"><i>Perhaps Britain's least appetisingly-named meal, this dish of sausages in Yorkshire pudding batter is said to have gained its unusual moniker because it looks like toads popping their heads from a hole
			</i></p>
			<a class="btn red-btn" href="{{ URL::route('search') }}" role="button">Find Restaurants</a>
		</div>

		<div style="display:none" class="text5">
			<h3 style="color: #db2e2e"><i>Dhosa</i></h3>
			<p style="color: #888; margin-bottom: 20px;"><i>Perhaps Britain's least appetisingly-named meal, this dish of sausages in Yorkshire pudding batter is said to have gained its unusual moniker because it looks like toads popping their heads from a hole
			</i></p>
			<a class="btn red-btn" href="{{ URL::route('search') }}" role="button">Find Restaurants</a>
		</div>

		<div style="display:none" class="text6">
			<h3 style="color: #db2e2e"><i>Chinese</i></h3>
			<p style="color: #888; margin-bottom: 20px;"><i>Perhaps Britain's least appetisingly-named meal, this dish of sausages in Yorkshire pudding batter is said to have gained its unusual moniker because it looks like toads popping their heads from a hole
			</i></p>
			<a class="btn red-btn" href="{{ URL::route('search') }}" role="button">Find Restaurants</a>
		</div>

		<div style="display:none" class="text7">
			<h3 style="color: #db2e2e"><i>Mexican</i></h3>
			<p style="color: #888; margin-bottom: 20px;"><i>Perhaps Britain's least appetisingly-named meal, this dish of sausages in Yorkshire pudding batter is said to have gained its unusual moniker because it looks like toads popping their heads from a hole
			</i></p>
			<a class="btn red-btn" href="{{ URL::route('search') }}" role="button">Find Restaurants</a>
		</div>
		</center>
		
	</div>
	<div class="col-lg-3 col-md-3 col-sm-2">
	</div>

</div>

<!-- FODD AND COMBOS -->
<div class="container-fluid" style="padding: 80px 0 0px;">
	<div class="col-xs-12" style="margin-bottom: 35px">
		<h1 style="margin-left: 30px">OFFERS AND <b>COMBOS</b></h1>
		<hr>
		<hr>
	</div>

	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
		<center>
			<img src="public/images/red_temple_top.png" class="img-responsive">
			<div class="combo-offer-box">	
				<img alt="detail left" src="public/images/temple_detail_l.png" class="img-responsive">	
				<img alt="detail right" src="public/images/temple_detail_r.png" class="img-responsive">	
				<p>paneer tikka masala
				<span>1</span>
				</p>
				<p>cheese butter masala
				<span>1</span>
				</p>
				<p>Butter Roti
				<span>4</span>
				</p>
				<p>masala papad
				<span>1</span>
				</p>
				<p>butter milk
				<span>1</span>
				</p>
				<p>jeera rice
				<span>1</span>
				</p>
				<p>tadka dal
				<span>1</span>
				</p>
			</div>
			<div class="combo-bottom-head-red">
				<div class="combo-head">decent combo</div>
				<div class="combo-price">rs 325</div>
				<span class="portion">ideal to share between <b>4 persons</b></span>
			</div>
			<div class="combo-bottom-bottom-red">
				<span class="combo-add red">ADD TO CART</span>
			</div>
		</center>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
		<center>
			<img src="public/images/gold_temple_top.png" class="img-responsive">
			<div class="combo-offer-box">
				<img alt="detail left" src="public/images/temple_detail_l.png" class="img-responsive">	
				<img alt="detail right" src="public/images/temple_detail_r.png" class="img-responsive">		
				<p>kaju kari
				<span>1</span>
				</p>
				<p>mix vegetable
				<span>1</span>
				</p>
				<p>Butter Roti
				<span>4</span>
				</p>
				<p>masala papad
				<span>1</span>
				</p>
				<p>butter milk
				<span>1</span>
				</p>
				<p>jeera rice
				<span>1</span>
				</p>
				<p>tadka dal
				<span>1</span>
				</p>
			</div>
			<div class="combo-bottom-head-gold">
				<div class="combo-head">sahyog combo</div>
				<div class="combo-price">rs 350</div>
				<span class="portion">ideal to share between <b>4 persons</b></span>
			</div>
			<div class="combo-bottom-bottom-gold">
				<span class="combo-add gold">ADD TO CART</span>
			</div>
		</center>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
		<center>
			<img src="public/images/red_temple_top.png" class="img-responsive">
			<div class="combo-offer-box">
				<img alt="detail left" src="public/images/temple_detail_l.png" class="img-responsive">	
				<img alt="detail right" src="public/images/temple_detail_r.png" class="img-responsive">		
				<p>paneer lasaniya
				<span>1</span>
				</p>
				<p>paneer balti
				<span>1</span>
				</p>
				<p>Butter Roti
				<span>4</span>
				</p>
				<p>masala papad
				<span>1</span>
				</p>
				<p>butter milk
				<span>1</span>
				</p>
				<p>cheese pulav
				<span>1</span>
				</p>
				<p>tadka dal
				<span>1</span>
				</p>
			</div>
			<div class="combo-bottom-head-red">
				<div class="combo-head">kalarav combo</div>
				<div class="combo-price">rs 300</div>
				<span class="portion">ideal to share between <b>4 persons</b></span>
			</div>
			<div class="combo-bottom-bottom-red">
				<span class="combo-add red">ADD TO CART</span>
			</div>
		</center>
	</div>

	<div class="col-lg-12" style="margin-top:50px">
		<center>
			<span class="dntlike1">you don't like them?</span><br>
			<span class="dntlike2">don't worry! we change the combos <span style="color: #db2e2e;">every month!</span></span>
		</center>
	</div>
</div>


<!-- FOR OTHER THEME -->
<!-- <div class="container-fluid hidden-xs" style="padding:0px;">
	<div class="image_content">
		<img src="public/images/index-bg.jpg" class="img-responsive">
		<div class="overl">Aashay</div>
	</div>
</div> -->

{{ HTML::style('css/jquery.autocomplete.css') }}

@stop

@section('javascr')
{{ HTML::script('js/jquery.autocomplete.js') }}
@stop
