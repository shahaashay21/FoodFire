<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");

class Cart extends BaseController{

	public function add(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		GLOBAL $itemid, $qty, $food_diet, $food_taste, $extra;
		$itemid = Input::get('itemid');
		$qty = Input::get('qty');
		$food_diet = Input::get('food_diet');
		$food_taste = Input::get('food_taste');

		//QUERY FOR DATABASE CATEGORY NAME
		$extra_que = DB::table('fd_subitems')
					->select('category')
					->where('itemid', '=', $itemid)->distinct()->get();

		$extra_que = json_decode(json_encode($extra_que),1);
		$extra = array();

		//FETCH VALUE FROM REQUEST USING DATABASE CATEGORY NAME
		for($i=0; $i<count($extra_que); $i++){
			$extra_temp = Input::get($extra_que[$i]['category']);
			if($extra_temp != null || $extra_temp != ''){
				$extra_temp = implode(",", $extra_temp);
				array_push($extra, $extra_temp);
			}
		}
		sort($extra);

		//CONVERT ARRAY INTO STRING USING SEPARATED BY COMMA
		if($extra != null || $extra != ''){
			$extra = implode(",", $extra);
		}
		//Log::info($extra);

		// ADD REQUESTED ITEM INTO SESSION OR DATABASE

		//FIRST ADD NEW ITEM IN SESSION
		$this->addinSession();

		// CHECK USER LOGIN
		if(Auth::check()){

			// ADD ITEM INTO DATABASE
			$this->addAuth();

			$user_data = Auth::user();

			//FETCH ALL ITEMS FROM DATABASE TO DISPLAY
			$data_cart = DB::table('fd_cart')
						->where('cusunkid', '=', $user_data['cusunkid'])
						->get();
			$finalitems = json_decode(json_encode($data_cart),1);

			//CALL FUNCTION TO DISPLAY CART
			return $this->cartDetails($finalitems);

		}else{

			// Log::info(Session::get('cart'));
			//Session::forget('cart');
			return $this->cartDetails(Session::get('cart'));

		}
	}


	public function addinSession(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		GLOBAL $itemid, $qty, $food_diet, $food_taste, $extra;

		// CREATE ARRAY FOR REQUESTED ITEM
		$temp_cart = array('itemid'=>$itemid, 'qty'=>$qty, 'food_diet'=>$food_diet, 'food_taste'=>$food_taste, 'extra'=>$extra);

		//CHECK SESSION IN EXIST OR NOT
		if(Session::has('cart')){
			$cart = Session::get('cart');
			$item_exist = false;
			for($i=0; $i<count($cart); $i++){
				// Log::info($cart[$i]['itemid']);

				//CHECK VALUE FOR ALREADY AVAILABLE IF YES THEN JUST ADD QTY
				if($cart[$i]['itemid'] == $itemid && $cart[$i]['food_diet'] == $food_diet && $cart[$i]['food_taste'] == $food_taste && $cart[$i]['extra'] == $extra){
					$cart[$i]['qty'] += $qty;
					$item_exist = true;
				}
			}
			if($item_exist == false){
				array_push($cart,$temp_cart);
			}
			Session::put('cart',$cart);

		}else{

			//CREATE SESSION AND ADD ITEM INTO IT
			$cart_item = [];
			array_push($cart_item,$temp_cart);

			Session::put('cart',$cart_item);
		}
		return;
	}


	public function addAuth(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		GLOBAL $itemid, $qty, $food_diet, $food_taste, $extra;

		$user_data = Auth::user();

		
		if(Auth::check()){
			// FETCH ITEMS FROM SESSION AND THEN REMOVE SESSION
			$sessionitem = Session::get('cart');
			Session::forget('cart');

			// FETCH ITEMS DATA FROM DATABASE BEFOR ITEM IS ADDED
			$data_cart = DB::table('fd_cart')
						->where('cusunkid', '=', $user_data['cusunkid'])
						->get();
			$data_cart = json_decode(json_encode($data_cart),1);

			// ADD ALL SESSION ITEMS INTO DATABASE
			for($i=0; $i<count($sessionitem); $i++){
				$item_exist = false;
				for($a=0; $a<count($data_cart); $a++){
					// ITEM ALREADY AVAILABLE THEN JUST ADD QTY
					if($data_cart[$a]['itemid'] == $sessionitem[$i]['itemid'] && $data_cart[$a]['food_diet'] == $sessionitem[$i]['food_diet'] && $data_cart[$a]['food_taste'] == $sessionitem[$i]['food_taste'] && $data_cart[$a]['extra'] == $sessionitem[$i]['extra']){
							
							$data_cart[$a]['qty'] += $sessionitem[$i]['qty'];
							DB::table('fd_cart')
								->where('cusunkid', '=', $user_data['cusunkid'])
								->where('itemid', '=', $sessionitem[$i]['itemid'])
								->where('food_diet', '=', $sessionitem[$i]['food_diet'])
								->where('food_taste', '=', $sessionitem[$i]['food_taste'])
								->where('extra', '=', $sessionitem[$i]['extra'])
								->update(array('qty' => $data_cart[$a]['qty']));
							$item_exist = true;
					}
				}
				if($item_exist == false){

						// ADD ITEM INTO DATABASE
						DB::table('fd_cart')->insert(
								array('cusunkid' => $user_data['cusunkid'], 'itemid' => $sessionitem[$i]['itemid'],
									'qty' => $sessionitem[$i]['qty'], 'food_diet' => $sessionitem[$i]['food_diet'], 'food_taste' => $sessionitem[$i]['food_taste'],
									'extra' => $sessionitem[$i]['extra'])
								);
				}
			}
		}
	}


	public function displayCart(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$this->addAuth();
		$finalitems = "";
		if(Auth::check()){

			$user_data = Auth::user();

			//FETCH ALL ITEMS FROM DATABASE TO DISPLAY
			$data_cart = DB::table('fd_cart')
						->where('cusunkid', '=', $user_data['cusunkid'])
						->get();
			$finalitems = json_decode(json_encode($data_cart),1);
			
		}else{
			if(Session::has('cart')){
				$finalitems = Session::get('cart');	
			}
			
		}
		return $this->cartDetails($finalitems);
	}

	//REMOVE PRODUCT FROM CART
	public function removeProduct(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$item = Input::get("item");

		if(Auth::check()){
			$user_data = Auth::user();

			$cart_data = DB::table("fd_cart")
			->where('cusunkid', '=', $user_data['cusunkid'])
			->get();

			$cart_data = json_decode(json_encode($cart_data),1);

			for($b=0; $b<count($cart_data); $b++){
				$sub_string = str_replace(",", "", $cart_data[$b]['extra']);
				$check_string = $cart_data[$b]['itemid'].ucwords($cart_data[$b]['food_diet']).ucwords($cart_data[$b]['food_taste']).$sub_string;

				if($item == $check_string){
					DB::table('fd_cart')
					->where('cusunkid', '=', $user_data['cusunkid'])
					->where('itemid', '=', $cart_data[$b]['itemid'])
					->where('food_diet', '=', $cart_data[$b]['food_diet'])
					->where('food_taste', '=', $cart_data[$b]['food_taste'])
					->where('extra', '=', $cart_data[$b]['extra'])
					->delete();
				}
				// Log::info($check_string);
			}
		}else{
			if(Session::has('cart')){
				$cart_data = Session::get('cart');
				for($b=0; $b<count($cart_data); $b++){
					$sub_string = str_replace(",", "", $cart_data[$b]['extra']);
					$check_string = $cart_data[$b]['itemid'].ucwords($cart_data[$b]['food_diet']).ucwords($cart_data[$b]['food_taste']).$sub_string;

					// Log::info('here');
					// Log::info($item);
					// Log::info($check_string);
					if($item == $check_string){
						unset($cart_data[$b]);
					}
				}

				$cart_data = array_values($cart_data);
				Session::put('cart',$cart_data);
			}else{

			}
		}
		return json_encode('ok') ;
	}


	// DISPLAY CART ITEM AS PER REQUESTED
	public function cartDetails($cart){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		// Session::forget('cart');
		// Log::info(Session::get('cart'));
		// return;
		// Log::info($cart);
		if($cart == null || $cart == ''){
			$cartData['cart'] = '<div class="items-category-white-box">
							<h1>
						    	<b>YOUR ORDER</b><i class="fa fa-briefcase fa-2x" style="color:#db2e2e; float:right; margin-right:30px"></i>
						  	</h1>
						  	<hr><hr><br>

					  		<div class="row" style="border-top: 1px solid #efeeea; margin:5px 10px 10px;">
								<div class="well">Your shopping cart is empty!</div>
							</div>
						</div>';
			$cartData['qty'] = "";
		}else{
			$total_item = 0;
			$item = array();
			for($i=0; $i<count($cart); $i++){
				array_push($item,$cart[$i]['itemid']);
			}

			$vendorname = 	DB::table('fd_vendor as fv')
							->leftJoin('fd_items as fi', 'fi.vendorunkid', '=', 'fv.vendorunkid')
							->select('fv.vendor_name', 'fv.vendor_fullurl', 'fv.vendorunkid', 'fv.tax', 'fv.del_time')
							->whereIn('fi.id', $item)
							->distinct()
							->get();

			$vendorname = json_decode(json_encode($vendorname),1);
			// Log::info($vendorname);

			$am_vendor = 0;
			$am_subitem = 0;
			$am_tax = 0;
			$am_delivery = 0;	
			$am_del_tax = 0;
			$am_total = 0;
			$vendor_count = 0;

			$cartData['cart'] = '<div class="items-category-white-box">
							<h1>
						    	<b>YOUR ORDER</b><i class="fa fa-briefcase fa-2x" style="color:#db2e2e; float:right; margin-right:30px"></i><!-- <i class="fa fa-suitcase fa-2x" style="color:#db2e2e; float:right; margin-right:30px"></i> -->
						  	</h1>
						  	<hr><hr><br>

						  	<div class="approx-time">
						  		<b>Approx. Delivery Time : </b>
						  		<div style="display:inline-table">';
						  			// 11:53 PM
						  			$time = time();
						  			for($j=0; $j<count($vendorname); $j++){
						  				// Log::info($vendorname[$j]['del_time']);
						  				$time = $time+(60*$vendorname[$j]['del_time']);
						  			}
						  			// Log::info($time);
						  			// $time = $time-(15*60);
						  			// Log::info($time);
						  			$deltime = date("h:i a",$time);

			$cartData['cart'] .= 			strtoupper($deltime).' <i class="fa fa-clock-o fa-lg"></i>
						  		</div>
						  	</div>

						  	<div class="cart-vendor" style="font-size: 14px">
						  		<div class="cart-vendor-details" style="max-height:250px; overflow-y:auto">';
						  		for($j=0; $j<count($vendorname); $j++){
						  		$cartData['cart'] .='<div class="cart-seller">
									  			<a style="text-decoration:none" href="'.$vendorname[$j]['vendor_fullurl'].'">
									  				<b>'.ucwords($vendorname[$j]['vendor_name']).'</b>
									  			</a>';
									  		$am_vendor = 0;
									  		for($l=0; $l<count($cart); $l++){
									  			
										  		$itemname = DB::table('fd_items as fi')
										  					->leftJoin('cf_items as ci', 'ci.itemunkid', '=', 'fi.itemunkid')
										  					->select('ci.name as itemname', 'fi.price as price')
										  					->where('fi.vendorunkid', '=', $vendorname[$j]['vendorunkid'])
										  					->where('fi.id', '=', $cart[$l]['itemid'])
										  					->get();
										  		$itemname = json_decode(json_encode($itemname),1);
										  		// Log::info($itemname);

										  		for($k=0; $k<count($itemname); $k++){
										  			$total_item += intval($cart[$l]['qty']);
										  			$am_subitem = 0;
									$cartData['cart'] .=	'<div class="container-fluid">
											  			<div class="row">
											  				<div class="seller-product" style="font-size:13px">
												  				<div class="col-xs-6 no-padding" style="padding-left:5px">
												  					<span class="product-name">'.ucwords($itemname[$k]['itemname']).'</span>';
												  					// Log::info('Extra'.$cart[$l]['extra']);
												  					if($cart[$l]['food_diet'] != null || $cart[$l]['food_diet'] != ''){
												  						$cartData['cart'] .='<div class="col-xs-12 no-padding">
																  						<small>- '.ucwords($cart[$l]['food_diet']).'</small>
																  					</div>';
												  					}
												  					if($cart[$l]['food_taste'] != null || $cart[$l]['food_taste'] != ''){
												  						$cartData['cart'] .='<div class="col-xs-12 no-padding">
																  						<small>- '.ucwords($cart[$l]['food_taste']).'</small>
																  					</div>';
												  					}
												  					$del_sub_array = array();
												  					$del_sub_string = "";
												  					if($cart[$l]['extra'] != null || $cart[$l]['extra'] != ''){

													  					$subitem = DB::table('fd_subitems')
													  								->where('itemid', '=', $cart[$l]['itemid'])
													  								->whereIn('subitemid', explode(',',$cart[$l]['extra']))
													  								->get();
													  					$subitem = json_decode(json_encode($subitem),1);
													  					//Log::info($subitem);
													  					
													  					for($m=0; $m<count($subitem); $m++){
													  						if($subitem[$m]['item_price'] == null || $subitem[$m]['item_price'] == ''){
													  							$cartData['cart'] .='<div class="col-xs-12 no-padding">
																		  						<small>- '.ucwords($subitem[$m]['item_name']).'</small>
																		  					</div>';
															  				}else{
															  					$am_subitem += intval($cart[$l]['qty'])*intval($subitem[$m]['item_price']);
															  					$cartData['cart'] .='<div class="col-xs-8 no-padding">
																		  						<small>- '.ucwords($subitem[$m]['item_name']).'</small>
																		  					</div>
																		  					<div class="col-xs-4 no-padding">
																		  						<small style="float:right;"><i class="fa fa-inr"></i> '.number_format(($subitem[$m]['item_price']),2,".","").'</small>
																		  					</div>';
															  				}
															  				array_push($del_sub_array, $subitem[$m]['subitemid']);
													  					}
													  					sort($del_sub_array);
													  					for($c=0; $c<count($del_sub_array); $c++){
													  						$del_sub_string .= $del_sub_array[$c];
													  					}
													  				}
													  				// Log::info($del_sub_string);	
												$cartData['cart'] .=	'</div>
												  				<div class="col-xs-1 no-padding">
												  					'.$cart[$l]['qty'].'
												  				</div>
												  				<div class="col-xs-1 no-padding">
												  					<span title="Delete" data-placement="top" data-toggle="tooltip"><a onclick="delProduct(\''.$cart[$l]['itemid'].$cart[$l]['food_diet'].$cart[$l]['food_taste'].$del_sub_string.'\')" ><i class="fa fa-times fa-white" style="cursor:pointer;"></i></a></span>
												  				</div>
												  				<div class="col-xs-4 no-padding" style="text-align:right">';
												  					$item_total = (intval($itemname[$k]['price'])*intval($cart[$l]['qty']))+intval($am_subitem);
												  					$am_vendor += $item_total;
												$cartData['cart'] .=		'<i class="fa fa-inr"></i> '.number_format(($item_total),2,".","").'
												  				</div>
												  			</div>
											  			</div>
											  		</div>';
										  		}
									  		}
									  		$am_total += $am_vendor;
							$cartData['cart'] .=	'<div class="container-fluid">
									  			<div class="row" style="text-align:right">
									  				<div class="col-xs-8 no-padding">
										  				Vendor Sub-Total:
										  			</div>
										  			<div class="col-xs-4 no-padding">
										  				<i class="fa fa-inr"></i> '.number_format(($am_vendor),2,".","").'
										  			</div>';
								  			if($vendorname[$j]['tax'] != null || $vendorname[$j]['tax'] != '')
								  			{
								  				$am_tax += round(($am_vendor*$vendorname[$j]['tax'])/100,2);
								$cartData['cart'] .=	'<div class="col-xs-8 no-padding">
									  				Taxes (Vendor - '.$vendorname[$j]['tax'].'%):
									  			</div>
									  			<div class="col-xs-4 no-padding">
									  				<i class="fa fa-inr"></i> '.round(($am_vendor*$vendorname[$j]['tax'])/100,2).'
									  			</div>';
								  			}

								$cartData['cart'] .=    '</div>
											</div>
										</div>';
								$vendor_count += 1;
						  		}

				$cartData['cart'] .=    '</div><div class="cart-seller" style="border-width:5px">
					  				<div class="container-fluid">
						  				<div class="row" style="text-align:right">
						  					<div class="col-xs-8 no-padding">
								  				Sub-Total:
								  			</div>
								  			<div class="col-xs-4 no-padding">
								  				<i class="fa fa-inr"></i> '.number_format(($am_total),2,".","").'
								  			</div>

								  			<div class="col-xs-8 no-padding">
								  				Taxes (Vendor):
								  			</div>
								  			<div class="col-xs-4 no-padding">
								  				<i class="fa fa-inr"></i> '.number_format(($am_tax),2,".","").'
								  			</div>';
								  			$am_delivery = number_format(($vendor_count*25),2,".","");
								  			$am_del_tax = number_format((($vendor_count*25)*0.14),2,".","");
						$cartData['cart'] .=		'<div class="col-xs-8 no-padding">';
								  			if($vendor_count == 1){
								  				$cartData['cart'] .='Vendor Delivery:';
								  			}else{
								  				$cartData['cart'] .='Multi-Vendor Delivery:';
								  			}
						$cartData['cart'] .=		'</div>
								  			<div class="col-xs-4 no-padding">
								  				<i class="fa fa-inr"></i> '.$am_delivery.'
								  			</div>

								  			<div class="col-xs-8 no-padding">
								  				Service Tax(Delivery - 14%):
								  			</div>
								  			<div class="col-xs-4 no-padding">
								  				<i class="fa fa-inr"></i> '.$am_del_tax.'
								  			</div>
						  				</div>
					  				</div>

					  				<div class="container-fluid">
					  					<div class="row">
						  					<center>
							  					<div class="cart-total">
							  						<div class="col-xs-6">
										  				Total:
										  			</div>
										  			<div class="col-xs-6">';
										  				$grand_total = number_format(($am_total+$am_tax+$am_delivery+$am_del_tax),2,".","");
						$cartData['cart'] .=	  				'<i class="fa fa-inr"></i> '.$grand_total.'
										  			</div>
							  					</div>
						  					</center>
						  				</div>
					  				</div>
					  			</div>

						  	</div>
				  	
						</div>';
						$cartData['qty'] = $total_item;
						$cartData['total'] = $grand_total;
		}
		return json_encode($cartData);
	}
}