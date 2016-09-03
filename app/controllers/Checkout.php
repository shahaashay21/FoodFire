<?php

use \Address;

class Checkout extends BaseController {
	
	public function main()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		//Session::flash("aas","Aashay");
		$addressobj = new Address();
		$htmladd = json_decode($addressobj->dispalyAddress());
		// Log::info($htmladd);
		return View::make('checkout')
					->with('addresss', $htmladd);
	}


    public function finalOrderCheck(){
    	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
    	$data = array();
    	$address = Input::get('address');
    	$payment = Input::get('payment');
    	Log::info('Address id '.$address);
    	if(Auth::check()){

    		//CHECK ADDRESS FIELD NULL OR NOT
    		if($address == '' || $address == NULL || $address == 'undefined'){
    			$data['alert'] = 1;
				$data['alerttype'] = "alert-notify-danger";
			    $data['message'] = "Please select your address";
				return json_encode($data);
    		}

    		//CHECK PAYMENT FIELD NULL OR NOT
    		if($payment == '' || $payment == NULL || $payment == 'undefined'){
    			$data['alert'] = 1;
				$data['alerttype'] = "alert-notify-danger";
			    $data['message'] = "Please selecet your Payment method";
				return json_encode($data);
    		}

    		//CHECK ADDRESS IS AVAILABLE IN TABLE OR NOT
    		$add_check = DB::table('fd_cusaddress')->where('addunkid', '=', $address)->first();

    		if(is_null($add_check)){
    			$data['alert'] = 1;
				$data['alerttype'] = "alert-notify-danger";
			    $data['message'] = "Something Went Wrong, Please Refresh And Try Again";
				return json_encode($data);
			}

			//CHECK CUSTOMER IS AVAILABLE IN TABLE OR NOT
			$cus_check = DB::table('fd_cus')->where('cusunkid', '=', Auth::user()->cusunkid)->first();

    		if(is_null($cus_check)){
    			$data['alert'] = 1;
				$data['alerttype'] = "alert-notify-danger";
			    $data['message'] = "Something Went Wrong, Please Refresh And Try Again";
				return json_encode($data);
			}

			//CHECK PAYMENT METHOD IS AVAILABLE IN TABLE OR NOT
			$payment_check = DB::table('cf_payment')->where('paymentunkid', '=', $payment)->first();

    		if(is_null($payment_check)){
    			$data['alert'] = 1;
				$data['alerttype'] = "alert-notify-danger";
			    $data['message'] = "Something Went Wrong, Please Refresh And Try Again";
				return json_encode($data);
			}

			
			$data = array();
			$data['redirect'] = URL::route('order');
			Session::flash('ordered','completed');
			Session::flash('address', Input::get('address'));
			Session::flash('payment', Input::get('payment'));
			return json_encode($data);
			
    	}else{
    		$data['modal'] = 0;
			$data['alert'] = 1;
			$data['alerttype'] = "alert-notify-danger";
		    $data['message'] = "You Must Log In Or Create An Account To Place Order";
			return json_encode($data);
    	}
    }

    public function finalOrder(){
    	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

    	if(Session::has('ordered')){
    		Session::forget('ordered');

    		//MAKE FINAL ORDER // SEND DATA FROM FD_CART TO FD_ORDER AND FD_ORDERDETAILS USING TRANSACTION
    		$data = DB::transaction(function() {
    			
    			Log::info('Making Final Order For Valuable Customer');

    			$address = Session::pull('address');
    			$payment = Session::pull('payment');

    			Log::info('Address id after pull '.$address);

    			
				$order_query = DB::select('select get_nextid("fd_order") as id');
				$orderunkid = $order_query[0]->id;
				Log::info("HERE IS NEW ORDER ID ". $orderunkid);

				// INSERT DATA IN FD_ORDER FROM FD_CART
    				DB::table('fd_order')->insert([
    					'orderunkid' => $orderunkid,
    					'cusunkid' => Auth::user()->cusunkid,
    					'addunkid' => $address,
    					'paymentunkid' => $payment
    					]);

				//FETCH ALL VENDOR BASED ON FD_CART TABLE
				$vendor = 	DB::table('fd_cart as fc')
								->leftJoin('fd_items as fi', 'fi.id', '=', 'fc.itemid')
								->leftJoin('fd_vendor as fv', 'fi.vendorunkid', '=', 'fv.vendorunkid')
								->select('fv.vendorunkid', 'fv.tax')
								->where('fc.cusunkid', '=', Auth::user()->cusunkid)
								->distinct()
								->get();

				$vendor = json_decode(json_encode($vendor),1);
				// Log::info($vendor);

				//LOOP FOR DIFFERENT VENDORS
				$grand_total = 0;
				$total_tax = 0;
				$total_delivery = 0;
				$vendor_count = 0;
				$qty = 0;
				for($k=0; $k<count($vendor); $k++){
					$vendor_tax = 0;
					$vendor_total = 0;

					//FETCH ALL ITEMS WITH PRICE FROM FD_CART
					$data_cart = DB::table('fd_cart as fc')
								->leftJoin('fd_items as fi', 'fc.itemid', '=', 'fi.id')
								->select('fc.cusunkid', 'fc.itemid', 'fc.qty', 'fc.food_diet', 'fc.food_taste', 'fc.extra', 'fi.price')
								->where('fc.cusunkid', '=', Auth::user()->cusunkid)
								->where('fi.vendorunkid', '=', $vendor[$k]['vendorunkid'])
								->distinct()
								->get();
					$data_cart = json_decode(json_encode($data_cart),1);

					//LOOP FOR DATA ITEMS
					for($i=0; $i<count($data_cart); $i++){
						$subitem_total = 0;
	    				if($data_cart[$i]['extra'] != null || $data_cart[$i]['extra'] != ''){

		  					$subitem = DB::table('fd_subitems')
		  								->select('item_price')
		  								->where('itemid', '=', $data_cart[$i]['itemid'])
		  								->whereIn('subitemid', explode(',',$data_cart[$i]['extra']))
		  								->get();
		  					$subitem = json_decode(json_encode($subitem),1);

		  					//TAKE VALUE OF SUBITEMS AND MAKE TOTAL OF IT
		  					for($j=0; $j<count($subitem); $j++){
		  						$subitem_total += $subitem[$j]['item_price'];
		  					}
		  				}
		  				$data_cart[$i]['price'] = (intval($data_cart[$i]['price'])*intval($data_cart[$i]['qty'])) + intval($subitem_total);
		  				$vendor_total += $data_cart[$i]['price'];

		  				//INSERT DATA IN FD_DETAILS
				  		DB::table('fd_orderdetails')->insert([
				  			'orderunkid' => $orderunkid,
				  			'itemid' => $data_cart[$i]['itemid'],
				  			'price' => $data_cart[$i]['price'],
				  			'qty' => $data_cart[$i]['qty'],
				  			'food_diet' => $data_cart[$i]['food_diet'],
				  			'food_taste' => $data_cart[$i]['food_taste'],
				  			'extra' => $data_cart[$i]['extra']
				  			]);
				  		$qty += $data_cart[$i]['qty'];
    				}

    				$vendor_count += 1;
    				Log::info("vendor :".$vendor_count);

    				$grand_total += $vendor_total;
    				$total_tax += round(($vendor_total*$vendor[$k]['tax'])/100,2);
				}
				Log::info("total vendor :".$vendor_count);
				$total_delivery = ($vendor_count*25);
				$total_del_tax = (($vendor_count*25)*0.14);

				Log::info("total delivery :".$total_delivery);

				$final_grand_total = intval($grand_total+$total_tax+$total_delivery+$total_del_tax);
				$cart_total = $grand_total+$total_tax;
				$delivery_total = $total_delivery+$total_del_tax;

				//UPDATE FD_ORDER WITH IT'S TOTAL VALUE
				DB::table('fd_order')
					->where('orderunkid', '=', $orderunkid)
					->update(array('total' => $final_grand_total));

				//DELETE ITEMS FROM CART TABLE FD_CART
				DB::table('fd_cart')
					->where('cusunkid', '=', Auth::user()->cusunkid)
					->delete();

				$returndata['qty'] = $qty;
				$returndata['cart_total'] = $cart_total;
				$returndata['delivery_total'] = $delivery_total;
				$returndata['grand_total'] = $final_grand_total;
				$returndata['orderunkid'] = $orderunkid;

				return $returndata;

			});

			//IF TRANSACTION WORKS... SEND EMAIL OF RECEIPT
			$cus_email = Auth::user()->email;
			$cus_name = Auth::user()->username;
			if($data['qty']){
				$orderid = $data['orderunkid'];
				$emaildata = $this->cartEmail($orderid);
				$emaildata = json_decode($emaildata);
				// Log::info($emaildata);
				$files_written = File::put('public/receipt/'.$orderid, $emaildata);
				Mail::send('emails.orders.order', array('emaildata' => $emaildata), function($message) use ($cus_email, $cus_name, $orderid)
				{
					$message->from('care@foodfire.in', 'FoodFire');
				    $message->to($cus_email, ucwords($cus_name));
				    $message->subject('FoodFire order #'.$orderid.' has been successfuly placed');
				    $message->bcc(array('receipt@foodfire.in', 'foodfireonline@gmail.com'));
				});

				// $filedata = File::get('receipt/'.$orderid);
				// Mail::send('emails.orders.order', array('emaildata' => $filedata), function($message) use ($cus_email, $cus_name, $orderid)
				// {
				// 	$message->from('care@foodfire.in', 'FoodFire');
				//     $message->to('aashay2105@gmail.com', ucwords($cus_name))->subject('FoodFire order #'.$orderid.' receipt');
				// });
			}
			return View::make('order')
					->with('items', $data['qty'])
					->with('cart', $data['cart_total'])
					->with('delivery', $data['delivery_total'])
					->with('total', $data['grand_total'])
					->with('orderid', $data['orderunkid'])
					->with('email', Auth::user()->email);

		
    	}else{
    		return Redirect::route('index');
    	}
    }

    public function emailTemplate(){
    	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

    	$emaildata = $this->cartEmail(5000000103);
    	$emaildata = json_decode($emaildata);
    	
    	return View::make('emailreceipt')
    			->with('emaildata', $emaildata);
    }

    // DISPLAY CART ITEM AS PER REQUESTED
	public function cartEmail($orderunkid = ""){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		// Session::forget('cart');
		// Log::info(Session::get('cart'));
		// return;
		// Log::info($cart);
		$cart = DB::table('fd_order as fo')
    			->leftJoin('fd_orderdetails as fod', 'fo.orderunkid', '=', 'fod.orderunkid')
    			->select('fo.cusunkid', 'fod.itemid', 'fod.price', 'fod.qty', 'fod.food_taste', 'fod.food_diet', 'fod.extra')
    			->where('fo.orderunkid', '=', $orderunkid)
    			->get();
    	$cart = json_decode(json_encode($cart),1);

    	Log::info($cart);

		if($cart == null || $cart == ''){
			$cartData['cart'] = '<div style="width:90%; padding:10px; font-family:Comic Sans MS,san seif">
								<div class="items-category-white-box"  style="background-color:#fff; border:#dfdfdf solid 1px; width:550px">
							<h1 style="font-size: 18px; padding-left: 16px; padding-top: 20px;">
						    	<img class="img-responsive" width="150px" height="40px" src="http://www.foodfire.in/public/images/FoodSymbol.png" style="margin-bottom:10px" alt="FoodFire"><b style="float:right; margin-right:10px">ORDER # 500000014</b>
						  	</h1>
						  	<hr style="border-top: 5px solid #db2e2e; float: left; height: 0; margin-top: 18px; width: 30%; margin-left: 0px"><hr style="margin: 34px 0px 0px; border-top: 1px solid #d2d2d2; height: 0;"><br>

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

			$cartData['cart'] = '<div style="width:100%; padding:10px; font-family:Comic Sans MS,san seif">
								
								<div class="items-category-white-box"  style="background-color:#fff; border:#dfdfdf solid 1px; width:560px; margin:auto;">
							<div style="font-size: 15px; padding-left: 16px; padding-top: 20px; width:100%">
								<div style="width:50%; float:left">
						    		<img class="img-responsive" width="150px" height="40px" src="http://www.foodfire.in/public/images/FoodSymbol.png" style="float:left; margin-bottom:10px" alt="FoodFire">
						    	</div>
						    	<div style="width:40%; float:right; margin-right:15px">
						    		<b style="float:right; margin-right:10px">ORDER # '.$orderunkid.'</b>
						    	</div>
						  	</div>
						  	<hr style="border-top: 5px solid #db2e2e; clear:both; height: 0; margin-top: 18px; width: 30%; margin-left: 0px"><hr style="margin-top: -10px; border-top: 1px solid #d2d2d2; height: 0;"><br>

						  	<div class="approx-time" style="background-color: #d9edf7; border-color: #bce8f1; color: #3a87ad; padding: 5px 10px; border-radius: 4px; margin: auto 10px 10px; text-align: center;">
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

			$cartData['cart'] .= 	strtoupper($deltime).' <i class="fa fa-clock-o fa-lg"></i>
						  		</div>
						  	</div>

						  	<div class="cart-vendor" style="font-size: 14px">
						  		<div class="cart-vendor-details">';
						  		for($j=0; $j<count($vendorname); $j++){
						  		$cartData['cart'] .='<div class="cart-seller" style="border-top: 1px solid #efeeea; margin-top:5px; padding: 0px 10px; font-size: 13px;">
									  			<a style="text-decoration:none; color:#357ebd; float:left" href="'.$vendorname[$j]['vendor_fullurl'].'">
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
									$cartData['cart'] .=	'<div class="container-fluid" style="display:table; margin:auto; width:100%">
											  			<div class="row" style="display:table; width:100%">
											  				<div class="seller-product" style="font-size:13px; width:100%">
												  				<div class="col-xs-6 no-padding" style="float:left; padding-left:5px; width:50%;">
												  					<span class="product-name" style="color: #db2e2e; text-align: left;">'.ucwords($itemname[$k]['itemname']).'</span>';
												  					// Log::info('Extra'.$cart[$l]['extra']);
												  					if($cart[$l]['food_diet'] != null || $cart[$l]['food_diet'] != ''){
												  						$cartData['cart'] .='<div class="col-xs-12 no-padding" style="float:left; width:100%">
																  						<small>- '.ucwords($cart[$l]['food_diet']).'</small>
																  					</div>';
												  					}
												  					if($cart[$l]['food_taste'] != null || $cart[$l]['food_taste'] != ''){
												  						$cartData['cart'] .='<div class="col-xs-12 no-padding" style="float:left; width:100%">
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
													  							$cartData['cart'] .='<div class="col-xs-12 no-padding" style="float:left; width:100%">
																		  						<small>- '.ucwords($subitem[$m]['item_name']).'</small>
																		  					</div>';
															  				}else{
															  					$am_subitem += intval($cart[$l]['qty'])*intval($subitem[$m]['item_price']);
															  					$cartData['cart'] .='<div class="col-xs-8 no-padding" style="float:left; width:66.6666%">
																		  						<small>- '.ucwords($subitem[$m]['item_name']).'</small>
																		  					</div>
																		  					<div class="col-xs-4 no-padding" style="float:left; width:33.3333%">
																		  						<small style="float:right;"><img src="http://www.foodfire.in/public/images/inr.png" height="10" width="10"> '.number_format(($subitem[$m]['item_price']),2,".","").'</small>
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
												  				<div class="col-xs-2 no-padding" style="float:left; width:16%">
												  					'.$cart[$l]['qty'].'
												  				</div>
												  				<div class="col-xs-4 no-padding" style="float:right; text-align:right; width:33%">';
												  					$item_total = (intval($itemname[$k]['price'])*intval($cart[$l]['qty']))+intval($am_subitem);
												  					$am_vendor += $item_total;
												$cartData['cart'] .=		'<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.number_format(($item_total),2,".","").'
												  				</div>
												  			</div>
											  			</div>
											  		</div>';
										  		}
									  		}
									  		$am_total += $am_vendor;
							$cartData['cart'] .=	'<div class="container-fluid" style="display:table; margin:auto; width:100%">
									  			<div class="row" style="display:table; text-align:right; width:100%">
									  				<div class="col-xs-8 no-padding" style="float:left; width:66.6667%">
										  				Vendor Sub-Total:
										  			</div>
										  			<div class="col-xs-4 no-padding" float:left; width:33.3333%">
										  				<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.number_format(($am_vendor),2,".","").'
										  			</div>';
								  			if($vendorname[$j]['tax'] != null || $vendorname[$j]['tax'] != '')
								  			{
								  				$am_tax += round(($am_vendor*$vendorname[$j]['tax'])/100,2);
								$cartData['cart'] .=	'<div class="col-xs-8 no-padding" style="float:left; width:66.6667%">
									  				Taxes (Vendor - '.$vendorname[$j]['tax'].'%):
									  			</div>
									  			<div class="col-xs-4 no-padding" style="float:left; width:33.3333%">
									  				<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.round(($am_vendor*$vendorname[$j]['tax'])/100,2).'
									  			</div>';
								  			}

								$cartData['cart'] .=    '</div>
											</div>
										</div>';
								$vendor_count += 1;
						  		}

				$cartData['cart'] .=    '</div><div class="cart-seller" style="border-top: 1px solid #efeeea; margin-top:5px; padding: 0px 10px; font-size: 13px; border-width:5px;">
					  				<div class="container-fluid" style="display:table; margin:auto; width:100%">
						  				<div class="row" style="display:table; text-align:right; width:100%">
						  					<div class="col-xs-8 no-padding" style="float:left; width:66.6667%">
								  				Sub-Total:
								  			</div>
								  			<div class="col-xs-4 no-padding" style="float:left; width:33.3333%">
								  				<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.number_format(($am_total),2,".","").'
								  			</div>

								  			<div class="col-xs-8 no-padding" style="float:left; width:66.6667%">
								  				Taxes (Vendor):
								  			</div>
								  			<div class="col-xs-4 no-padding" style="float:left; width:33.3333%">
								  				<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.number_format(($am_tax),2,".","").'
								  			</div>';
								  			$am_delivery = number_format(($vendor_count*25),2,".","");
								  			$am_del_tax = number_format((($vendor_count*25)*0.14),2,".","");
						$cartData['cart'] .=		'<div class="col-xs-8 no-padding" style="float:left; width:66.6667%">';
								  			if($vendor_count == 1){
								  				$cartData['cart'] .='Vendor Delivery:';
								  			}else{
								  				$cartData['cart'] .='Multi-Vendor Delivery:';
								  			}
						$cartData['cart'] .=		'</div>
								  			<div class="col-xs-4 no-padding" style="float:left; width:33.3333%">
								  				<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.$am_delivery.'
								  			</div>

								  			<div class="col-xs-8 no-padding" style="float:left; width:66.6667%">
								  				Service Tax(Delivery - 14%):
								  			</div>
								  			<div class="col-xs-4 no-padding" style="float:left; width:33.3333%">
								  				<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.$am_del_tax.'
								  			</div>
						  				</div>
					  				</div>

					  				<div class="container-fluid" style="display:table; margin:auto; width:100%;">
					  					<div class="row" style="display:table; text-align:right; width:100%">
						  					<center>
							  					<div class="cart-total" style="display:table; border-radius: 4px; padding: 8px 0px; background: #dff0d8; width:90%; text-align:right; color:black; font-weight:bold; font-size:14px; border-top: 1px solid #efeeea; margin:15px 0px;">
							  						<div class="col-xs-6" style="float:left; width:50%; padding:5px 0px">
										  				Total:
										  			</div>
										  			<div class="col-xs-6" style="padding:5px 15px">';
										  				$grand_total = number_format(($am_total+$am_tax+$am_delivery+$am_del_tax),2,".","");
						$cartData['cart'] .=	  				'<img src="http://www.foodfire.in/public/images/inr.png" height="12" width="12"> '.$grand_total.'
										  			</div>
							  					</div>
						  					</center>
						  				</div>
					  				</div>
					  			</div>

						  	</div>
				  	
						</div>
						
						</div>';
						$cartData['qty'] = $total_item;
						$cartData['total'] = $grand_total;
		}
		return json_encode($cartData['cart']);
	}
}