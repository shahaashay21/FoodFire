<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");

class Search extends BaseController{

	//FETCH VALUE TO RENDER VENDOR IN SEARCH PAGE
	public function main(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		$q = Input::get('q');

		// $data = Vendor::where('vendor_name', 'LIKE', $q.'%')->orderBy('vendor_name')->get();

		$city = Session::get('city');
		$data = DB::table('fd_vendor AS v')
		   ->leftJoin('fd_rate AS r', 'v.vendorunkid', '=', 'r.vendorunkid')
		   ->select('v.vendorunkid', 'v.vendor_url', 'v.vendor_name', 'v.dp', 'v.imgsrc', 'v.area', 'v.city', 'v.price', 'v.veg', 'v.jain', 
		   	'v.swaminarayan', 'v.non_veg', 'v.del_time', 'v.speciality', 
		   	DB::raw('DATEDIFF(NOW(),v.regdate) as born'), 
		   	DB::raw('(select count(*) from fd_rate where vendorunkid=v.vendorunkid and code_id=1) as likes'),
		    DB::raw('(select ROUND(AVG(rate), 1) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =2) as ratings'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =3) as favourite'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =4) as visit'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =2) as votes')
		    )
		   ->where('vendor_name', 'like', $q.'%')
		   ->where('isactive', '=', '1')
		   ->where('city', '=', $city)
		   ->orderBy('vendor_name')
		   ->distinct()
		   ->get();


		$ra = DB::table('fd_recentactivity AS ra')
				->leftJoin('fd_vendor AS v', 'ra.vendorunkid', '=', 'v.vendorunkid')
				->select('ra.id', 'ra.cusname', 'v.vendor_name', 'v.dp', 'v.imgsrc', 'v.vendor_url', 'v.city',
					DB::raw('TIMESTAMPDIFF(second,ra.entry_time,now()) AS diff')
					)
				->where('v.city', '=', $city)
				->orderBy('ra.entry_time','desc')
				->take(3)
				->distinct()
				->get();


		// JUST FOR INFORMATION THAT, ALSO WORK WITH SIMPLE RAW QUERY
		// $rawquery = "select DISTINCT v.vendorunkid, v.vendor_url, v.vendor_name, v.dp, v.area, v.city, v.price, v.veg, v.jain, v.swaminarayan, 
		// 			v.non_veg, v.del_time, v.speciality, DATEDIFF(NOW(),v.regdate) as born,
		// 			(SELECT COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =1) AS likes, 
		// 			(SELECT COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =3) AS favourite, 
		// 			(SELECT COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =4) AS visit, 
		// 			(SELECT ROUND(AVG(rate)) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =2) AS ratings 
		// 			FROM fd_vendor as s LEFT JOIN fd_rate as r ON v.vendorunkid = r.vendorunkid where v.vendor_name like :qname ORDER BY v.vendor_name";
		// $data = DB::select($rawquery,['qname' => $q.'%']);


		if($data != NULL){
			// $a = json_decode(json_encode($data), true);
			// Log::info('Value FETCHED ', $data);
			$vendor = $data;
			$data = json_encode($data);
			// $q = json_encode($q);
			Log::info($data);
			return View::make('search')
			->with('recentactivity', $ra)
			->with('vendors',$vendor)
			->with('data', $data)
			->with('search', $q);
		}else{
			// Log::info('else');
			$data = json_encode('NOTHING');
			return View::make('search')
			->with('recentactivity', $ra)
			->with('vendors','NOTHING')
			->with('data', $data)
			->with('search', $q);;
		}
		
	}

	//SEARCH PAGE RECENT ACTIVITY SERVER SIDE EVENT
	public function recentActivity(){
		header("Content-Type: text/event-stream");
		header('Cache-Control: no-cache');
		
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$city = Session::get('city');
		$ra = DB::table('fd_recentactivity AS ra')
				->leftJoin('fd_vendor AS v', 'ra.vendorunkid', '=', 'v.vendorunkid')
				->select('ra.id', 'ra.cusname', 'v.vendor_name', 'v.dp', 'v.imgsrc', 'v.vendor_url', 'v.city',
					DB::raw('TIMESTAMPDIFF(second,ra.entry_time,now()) AS diff')
					)
				->where('v.city', '=', $city)
				->orderBy('ra.entry_time','desc')
				->take(3)
				->distinct()
				->get();

		// echo "retry: 5000\n\n";
		echo "data: ".json_encode($ra)."\n\n";

		flush();
	}

	//UPDATE VENDOR LIKE, FAVOURITE, AND VISIT
	public function vendorupdatevalue(){
	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		if(Auth::check()){
			$codeid = Input::get('codeid');
			$vendorid = Input::get('vendorid');
			$cusid = Auth::user()->cusunkid;
			// Log::info('codeid: '.$codeid);
			// Log::info('vendorid: '.$vendorid);
			// Log::info('cusid: '.$cusid);

			
			$count = DB::table('fd_rate')->where('vendorunkid', '=', $vendorid)
										 ->where('cusunkid', '=', $cusid)
										 ->where('code_id', '=', $codeid)
										 ->count();
			if($count <= 0){
				if($codeid == '2'){
					$val = Input::get('val');
					// Log::info('val1: '.$val);
					$insertvalue = DB::table('fd_rate')->insert([
							'cusunkid' => $cusid,
							'vendorunkid' => $vendorid,
							'code_id' => $codeid,
							'rate' => $val
							]);	
				}else{
					$insertvalue = DB::table('fd_rate')->insert([
							'cusunkid' => $cusid,
							'vendorunkid' => $vendorid,
							'code_id' => $codeid
							]);	
				}
				return json_encode('ok');
			}else{
				if($codeid == '2'){
					$val = Input::get('val');
					// Log::info('val2: '.$val);
					$updatevalue = DB::table('fd_rate')
								->where('cusunkid', '=', $cusid)
								->where('vendorunkid', '=', $vendorid)
								->where('code_id', '=', $codeid)
								->update(['rate' => $val]);
					return json_encode('ok');
				}else{
					$deletequery = DB::table('fd_rate')
								 ->where('vendorunkid', '=', $vendorid)
								 ->where('cusunkid', '=', $cusid)
								 ->where('code_id', '=', $codeid)
								 ->delete();
					return json_encode('remove');
				}
			}
			
			
		}else{
			return json_encode('login fail');
		}
	}

	//RENDER VENDOR ITEM PAGE
	public function vendoritem($city='anand',$vendor_url){
	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		Session::put('vendor_url', $vendor_url);

		$auth = 0;
		// CHECK LOGIN OR NOT
		if(Auth::check()){
			$cusname = Auth::user()->username;
			$auth = 1;
		}else{
			$cusname = 'a new customer';
		}
		
		// FETCH VENDOR DETAILS
		$vendor = DB::table('fd_vendor AS v')
		   ->leftJoin('fd_rate AS r', 'v.vendorunkid', '=', 'r.vendorunkid')
		   ->select('v.vendorunkid', 'v.vendor_url', 'v.vendor_name', 'v.dp', 'v.area', 'v.city', 'v.price', 'v.veg', 'v.jain', 
		   	'v.swaminarayan', 'v.non_veg', 'v.del_time', 'v.speciality', 'v.imgsrc',
		   	DB::raw('DATEDIFF(NOW(),v.regdate) as born'), 
		   	DB::raw('(select count(*) from fd_rate where vendorunkid=v.vendorunkid and code_id=1) as likes'),
		    DB::raw('(select ROUND(AVG(rate), 1) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =2) as ratings'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =3) as favourite'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =4) as visit'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =2) as votes')
		    )
		   ->where('vendor_url', '=', $vendor_url)
		   ->where('isactive', '=', '1')
		   ->where('city', '=', $city)
		   ->distinct()
		   ->get();
		
		// INSERT USER ENTRY IN RECENT ACTIVITY TABLE
		$insertra = DB::table('fd_recentactivity')->insert([
			'cusname'=>$cusname,
			'vendorunkid'=>$vendor[0]->vendorunkid
			]);
		// $query = DB::getQueryLog();
		// $lastQuery = end($query);
		// print_r($lastQuery);


		$forcarturl = json_decode(json_encode($vendor),1);
		$vendorurl = $forcarturl[0]['vendor_url'];

		if($auth == 1){
			$rate = DB::table('fd_rate')
					->select('rate')
					->where('cusunkid', '=', Auth::user()->cusunkid)
					->where('vendorunkid', '=', $vendor[0]->vendorunkid)
					->where('code_id', '=', '2')
					->get();
			$aa = json_decode(json_encode($rate), true);
			// Log::info($aa[0]['rate']);
			$rate = json_encode($rate);


			if(isset($aa[0])){
				return View::make('items')
				->with('vendor', $vendor)
				->with('rating', $rate)
				->with('vendorname', $vendor[0]->vendor_name)
				->with('area', $vendor[0]->area)
				->with('city', $vendor[0]->city)
				->with('cart', json_decode($this->vendorproducts($vendorurl)));
			}else{
				return View::make('items')
				->with('vendor',$vendor)
				->with('vendorname', $vendor[0]->vendor_name)
				->with('area', $vendor[0]->area)
				->with('city', $vendor[0]->city)
				->with('cart', json_decode($this->vendorproducts($vendorurl)));
			}
			
		}else{
			return View::make('items')
			->with('vendor',$vendor)
			->with('vendorname', $vendor[0]->vendor_name)
			->with('area', $vendor[0]->area)
			->with('city', $vendor[0]->city)
			->with('cart', json_decode($this->vendorproducts($vendorurl)));
		}
		

		
	}


	//SEND PRODUCTS AS PER AJAX REQUEST WITH VENDORID
	public function vendorproducts($vendor_url = ""){

		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		
		$city = Session::get('city');
		if(Input::get('vendor_name')){
			$vendor_url = Input::get('vendor_name');	
		}
		

		//RETRIVE ALL PRODUCTS FOR PARTICULAR VENDOR
		$products = Fditems::with('cfitems.cfcategory')->whereHas('vend', function($q) use ($vendor_url,$city){
						$q->where('vendor_url', '=', $vendor_url)
						    ->where('isactive', '=', '1')
						    ->where('city', '=', $city);
					})->where('isactive', '=', '1')->where('isavailable', '=', '1')
					->get();

		//RETRIVE ALL CATEGORY OF PRODUCTS FOR PARTICULAR VENDOR
		$category = DB::table('cf_category as cc')
		  			->leftJoin('cf_items as ci', 'ci.categoryunkid', '=', 'cc.categoryunkid')
		  			->leftJoin('fd_items as fi', 'fi.itemunkid', '=', 'ci.itemunkid')
		  			->leftJoin('fd_vendor as fv', 'fv.vendorunkid', '=', 'fi.vendorunkid')
		  			->select('cc.categoryunkid','cc.name')
		  			->where('fi.isactive', '=', '1')->where('fi.isavailable', '=', '1')
		  			->where('fv.vendor_url', '=', $vendor_url)->where('fv.isactive', '=', '1')
		  			->where('fv.city', '=', $city)
		  			->orderBy(DB::raw('fi.sequence IS NULL'))
		  			->orderBy('fi.sequence')
		  			->distinct()
		  			->get();

		$category = json_decode(json_encode($category),1);
		




		//CREATE STRING TO DISPLAY PRODUCTS
		$count = Array();
		for($i=0; $i < sizeof($category); $i++ )
		{
			$l=0;
			for($j=0; $j < sizeof($products); $j++)
			{
						if($products[$j]->cfitems->cfcategory['name'] == $category[$i]['name'])
						{
							$l++;
						}
			}
			array_push($count, $l);
		}
		$str_products = '';
		$str_products .= '<div class="row">';
		$str_products .= '<div id="category-menu" class="visible-lg col-lg-3" style="margin-top: -15px">';
			$str_products .= '<div id="category-sticky" style="padding-top:5px">';
				$str_products .= '<div class="items-category-white-box">';
						$str_products .= '<h1>
										     <i class="fa fa-fighter-jet" style="color:#db2e2e"></i><b> CATEGORIES</b>
										  </h1>
										  <hr><hr>

										  <div class="cat-menu">';
										  for($i=0; $i < sizeof($category); $i++ )
										  {
											$str_products .= '<a style="text-decoration:none" href="#'.$category[$i]['name'].'"><h3 class="cat-items" style="border-top: none">'.ucwords($category[$i]['name']).' ('.$count[$i].')'.'</h3><a/>';
										  }
						$str_products .= '</div>';
				$str_products .= '</div>';
			$str_products .= '</div>';
		$str_products .= '</div>';
		$str_products .= '<div class="col-lg-9 items-menu-white-box">';
			for($i=0; $i < sizeof($category); $i++ )
			{
				if($i == 0){
					$str_products .= '<div class="menu-head" style="margin-top:0px" data-toggle="collapse" data-target="#'.$category[$i]['categoryunkid'] .'">';
				}else{
					$str_products .= '<div class="menu-head" data-toggle="collapse" data-target="#'.$category[$i]['categoryunkid'] .'">';
				}
				
				$str_products .= '<a id="'.$category[$i]['name'].'"></a>';
				$str_products .= ucwords($category[$i]['name']).' ('.$count[$i].')';
				$str_products .= '<i class="fa fa-minus-circle" style="float:right"></i>';
				$str_products .= '</div>';
					$k = 0; 
				for($j=0; $j < sizeof($products); $j++)
				{
					if($products[$j]->cfitems->cfcategory['name'] == $category[$i]['name'])
					{

						if($k == 0)
						{
							$str_products .= '<div class="container-fluid">';
								$str_products .= '<div class="row">';
									$str_products .= '<div id="'.ucwords($category[$i]['categoryunkid']).'" class="collapse in">';
						}



							$str_products .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="row product-detail">
											<div class="col-xs-8">
												<div class="product-name" onclick="productDetail('.$products[$j]['id'].')">'.ucwords($products[$j]->cfitems['name']).'</div>
											</div>
											<div class="col-xs-4" align="center">
												<div style="float:right">';
												if($products[$j]['originalprice']){
													$str_products .=	'<span class="text-muted" style="text-decoration:line-through; font-size:12px; margin-right: 5px">
                          													<i class="fa fa-inr" style="text-decoration:line-through"></i>
                          													 '.$products[$j]['originalprice'].'
                          												</span>';
												}
								$str_products .=	'<i class="fa fa-inr"></i> '.$products[$j]['price'].'
												</div>
											</div>
										</div>
									</div>';
								if($k == 0)
								{
						 			$k = 1; 
								}
					}
				}
							$str_products .= '</div>';
								$str_products .= '</div>';
									$str_products .= '</div>';
				
			}
			$str_products .= '</div>';
			$str_products .= '</div>';

			// $str_products .= "<script type='text/javascript'>
		 // 			$('.menu-head').on('click', function () {
			// 		$(this).children('.fa').toggleClass('fa-plus-circle');
			// 		$(this).children('.fa').toggleClass('fa-minus-circle');
			// 		});
			// 	</script>";


		return json_encode($str_products);
	}

	public function addReview(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$vendorunkid = Input::get('id');
		$rate = Input::get('rate');
		$user_review = Input::get('user_review');
		$vendor_favourite = Input::get('vendor_favourite');
		$vendor_like = Input::get('vendor_like');
		$vendor_visit = Input::get('vendor_visit');

		if(Auth::check()){

			$message1 = ["user_review.required" => "Please write your review",
						"rate.required" => "Please rate for your order"];
			$validator = Validator::make(Input::all(), [
				'user_review' => 'required',
				'rate' => 'required'
				], $message1);

			if($validator->fails()){
				$data['modal'] = 1;
				$data['alert'] = 0;
				$data['message'] = $validator->errors();
		    	return json_encode($data);
		    	//return 'failed';
		    }else{
		    	$review_id_query = DB::select('select get_nextid("fd_reviews") as id');
		    	$review_id = $review_id_query[0]->id;
		    	$in_review = DB::table('fd_reviews')->insert([
		    		'reviewunkid' => $review_id,
		    		'cusunkid' => Auth::user()->cusunkid,
		    		'vendorunkid' => $vendorunkid,
		    		'rate' => $rate,
		    		'review' => $user_review
		    		]);
		    	$data['modal'] = 0;
				$data['alert'] = 1;
				$data['alerttype'] = "alert-notify-success";
			    $data['message'] = "Thank You For Your Review";
				return json_encode($data);
		    }
		}else{
			$data['modal'] = 0;
			$data['alert'] = 1;
			$data['alerttype'] = "alert-notify-danger";
		    $data['message'] = "You Must Log In Or Create An Account To Place Order";
			return json_encode($data);
		}
	}
}