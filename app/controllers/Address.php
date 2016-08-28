<?php


class Address extends BaseController {

	public function newAddress()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$city = DB::table('cf_city')->get();
		$city = json_decode(json_encode($city),1);
		// Log::info($city[0]);

		$area = DB::table('cf_area')
				->where('cityunkid', '=', $city[0]['cityunkid'])
				->get();

		$area = json_decode(json_encode($area),1);

		// Log::info($area);

		$address = '<div class="modal fade" id="newaddress">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="ff-btn-modal-close pull-right" data-dismiss="modal">
										<i class="fa fa-times fa-white fa-lg"></i>
									</button>
									<h4 class="modal-title">Add Address</h4>
								</div>
								<div class="modal-body">
									<form name="newaddress" class="newaddress">
										<div class="row" style="margin:0px 20px">
											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Name</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<input class="input_text_box" type="text" placeholder="Name..." name="add_name" id="add_name">
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Address</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<input class="input_text_box" type="text" placeholder="Address..." name="add_address" id="add_address">
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">City</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<select name="add_city" id="address_city" class="input_text_box">';
														for($i=0; $i<count($city); $i++){
		$address .=											'<option value="'.$city[$i]['cityunkid'].'">'.$city[$i]['city_name'].'</option>';
														}
		$address .=									'</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Area</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<select name="add_area" id="address_area" class="input_text_box">';
														for($j=0; $j<count($area); $j++)
														{
		$address .=											'<option value="'.$area[$j]['areaunkid'].'">'.$area[$j]['area_name'].'</option>';
														}
		$address .=									'</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Pincode</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<input class="input_text_box" type="text" placeholder="Pincode..." name="add_pincode" id="add_pincode">
												</div>
											</div>
										</div>
									</form>	
								</div>
								<div class="modal-footer">
									<a class="btn btn-primary btn-lg" id="newaddress-form">Submit</a>
								</div>
							</div>
						</div>
					</div>


					<script>
					$("#address_city").change(function(){
						var city = $(this).find("option:selected").val();

						var cityarea = $.ajax({
							type: "POST",
							url: "/cityarea",
							data: "_token="+token+"&city="+city,
							dataType: "json",
							timeout: 4000,
							success:function(response){
								$("#address_area").empty();
								$.each(response, function(i,item){
									$("#address_area").append($("<option/>").val(response[i]["areaunkid"]).text(toTitleCase(response[i]["area_name"])));
								});
								cityarea.abort();
							},
							error: function(jqXHR, textStatus, errorThrown) {
						        if(textStatus=="timeout") {
						           $.ajax(this);
						        } 
						    }
						});
					});

					$("#newaddress-form").click(function(){

						var addressdata = $(".newaddress").serializeArray();
						addressdata.push({name: "_token", value: token});

						var addaddress = $.ajax({
							type: "POST",
							url: "/address/add",
							data: addressdata,
							dataType: "json",
							timeout: 4000,
							success: function(response){								
								if(response["alert"]){
									location.assign(window.location.pathname);
									// alertline(response["alerttype"],"<b>"+response["message"]+"</b>");
								}else{
									if(response["modal"] == 0){
										$("#newaddress").modal("hide");
									}
									$("#newaddress").modal("handleUpdate");
									$(".input_text_box").removeClass("inputerr");
									$(".ff-text-danger").remove();
									$.each(response["message"], function(i,item){
										$("#"+i).addClass("inputerr");
										$("#"+i).after("<div class=\'col-xs-12 ff-text-danger\'>"+item+"</div>");
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
					</script>';

		return json_encode($address);
	}

	public function cityArea(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$city = Input::get('city');

		$area = DB::table('cf_area')
				->where('cityunkid', '=', $city)
				->get();

		return json_encode($area);
	}


	public function addAddress(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$message = ["add_name.required" => "Name field is required",
					"add_address.required" => "Address field is required",
					"add_pincode.required" => "Pincode field is required",
					"add_pincode.size" => "Wrong pin code",
					"add_pincode.digits" => "Wrong pin code"];
		$validator = Validator::make(Input::all(), [
		        'add_name' => 'required',
		        'add_address' => 'required',
		        'add_city' => 'required',
		        'add_pincode' => 'required|size:6|digits:6',
		        'add_area' => 'required'
		    ], $message);

		if($validator->fails()){
			$data['modal'] = 1;
			$data['alert'] = 0;
			$data['message'] = $validator->errors();
	    	return json_encode($data);
	    	//return 'failed';
	    }else{

	    	if(Auth::check()){

		    	$cus_add_query = DB::select('select get_nextid("fd_cusaddress") as id');
			    $addunkid = $cus_add_query[0]->id;

			    $add_name = Input::get('add_name');
			    $add_address = Input::get('add_address');
			    $add_city = Input::get('add_city');
			    $add_area = Input::get('add_area');
			    $add_pincode = Input::get('add_pincode');

			    $data = array();
			    $countadd =	DB::table('fd_cusaddress')
			    		->where('cusunkid', '=', Auth::user()->cusunkid)
			    		->count();
			    Log::info($countadd);

			    
		    	$query = DB::table('fd_cusaddress')->insert([
		    	'addunkid' => $addunkid,
		    	'cusunkid' => Auth::user()->cusunkid,
		    	'name' => $add_name,
		    	'address' => $add_address,
		    	'area' => $add_area,
		    	'city' => $add_city,
		    	'pincode' => $add_pincode
		    	]);
			    
			    //IF FIRST TIME, MAKE IT DEFAULT
			    if($countadd == 0)
			    {
			    	DB::table('fd_cusaddress')
			    	->where('addunkid', '=', $addunkid)
			    	->update([
			    		'defaultadd' => 1
			    		]);
			    }

			    if($query){
			    	$data['modal'] = 0;
			    	$data['alert'] = 1;
			    	$data['alerttype'] = "alert-notify-success";
			    	$data['message'] = "Address has been successfuly added";
			    	return json_encode($data);
			    }
			}else{
				$data['modal'] = 0;
				$data['alert'] = 1;
				$data['alerttype'] = "alert-notify-danger";
			    $data['message'] = "You Must Log In To Add New Address";
				return json_encode($data);
			}

			$data['modal'] = 0;
			$data['alert'] = 1;
			$data['alerttype'] = "alert-notify-danger";
			$data['message'] = "Something Went Wrong. Try Again!";
		    return json_encode($data);

	    }
	}

	//DISPLAY ADDRESS FOR CHECKOUT PAGE
	public function dispalyAddress(){
    	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

    	$addressdata = "";
    	if(Auth::check()){
    		// Log::info('Auth');
	    	$address = DB::table('fd_cusaddress as fdcus')
	    				->leftJoin('cf_area as cfar', 'cfar.areaunkid', '=', 'fdcus.area')
	    				->leftJoin('cf_city as cfci', 'cfar.cityunkid' , '=', 'cfci.cityunkid')
	    				->leftJoin('cf_state as cfst', 'cfci.stateunkid', '=', 'cfst.stateunkid')
	    				->leftJoin('cf_country as cfco', 'cfco.countryunkid', '=', 'cfst.countryunkid')
	    				->where('cusunkid', '=', Auth::user()->cusunkid)
	    				->get();

	    	$address = json_decode(json_encode($address),1);

	    	// Log::info($address);
	    	if(count($address)){

		    	for($i=0; $i<count($address); $i++){

			    	$addressdata .= '<div class="row" style="margin-bottom:10px">
										<div class="col-xs-1">
											<input type="radio" value="'.$address[$i]['addunkid'].'" name="address" ';
											if($address[$i]['defaultadd'] == 1){
												$addressdata .= 'checked';
											}
					$addressdata .=			'>
										</div>
										<div class="col-xs-9">
											<div class="row no-padding">
												<div class="col-xs-12">
													<b>'.ucwords($address[$i]['name']).'</b>
												</div>
												<div class="col-xs-12">
													'.ucwords($address[$i]['address']).'
												</div>
												<div class="col-xs-12">
													'.ucwords($address[$i]['area_name']).'
												</div>
												<div class="col-xs-12">
													'.ucwords($address[$i]['city_name']).', '.ucwords($address[$i]['state_name']).', '.ucwords($address[$i]['country_name']).'
												</div>
											</div>
										</div>
									</div>';
				}
			}else{
				$addressdata .= '<div class="center-block col-xs-12" style="color:#db2e2e">
									Create New Address To Place Order
								</div>';
			}
		}
		return json_encode($addressdata);
    	
    }


    // DISPLAY ADDRESS FOR USER INFORMATION PAGE
    public function displayAddressForUserInfo(){
    	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

    	$addressdata = "";
    	if(Auth::check()){
    		// Log::info('Auth');
	    	$address = DB::table('fd_cusaddress as fdcus')
	    				->leftJoin('cf_area as cfar', 'cfar.areaunkid', '=', 'fdcus.area')
	    				->leftJoin('cf_city as cfci', 'cfar.cityunkid' , '=', 'cfci.cityunkid')
	    				->leftJoin('cf_state as cfst', 'cfci.stateunkid', '=', 'cfst.stateunkid')
	    				->leftJoin('cf_country as cfco', 'cfco.countryunkid', '=', 'cfst.countryunkid')
	    				->where('cusunkid', '=', Auth::user()->cusunkid)
	    				->get();

	    	$address = json_decode(json_encode($address),1);

	    	// Log::info($address);
	    	if(count($address)){

		    	for($i=0; $i<count($address); $i++){

			    	$addressdata .= '<div class="col-lg-4">
										<div class="panel panel-default">
											<div class="row" style="margin:5px">
												<div class="col-xs-12">
													<div class="row no-padding">
														<div class="col-xs-9">
															<b>'.ucwords($address[$i]['name']).'</b>
														</div>
														<div class="col-xs-3">';
															if($address[$i]['defaultadd'] == 1){
					$addressdata .=								'<span class="label label-default pull-right">Default</span>';
															}															
					$addressdata .=						'</div>
														<div class="col-xs-12">
															'.ucwords($address[$i]['address']).'
														</div>
														<div class="col-xs-12">
															'.ucwords($address[$i]['area_name']).'
														</div>
														<div class="col-xs-12">
															'.ucwords($address[$i]['city_name']).', '.ucwords($address[$i]['state_name']).', '.ucwords($address[$i]['country_name']).'
														</div>
														<div class="col-xs-6" style="margin-top:10px">
															<a class="btn btn-edit btn-warning pull-left" onclick="addressOperation('.$address[$i]['addunkid'].',1)" " data-title="Edit Adderess" data-placement="top" data-toggle="tooltip" style="color:#fff; margin-top:0px"><i class="fa fa-edit"></i> Edit</a>
														</div>
														<div class="col-xs-6" style="margin-top:10px">
															<a class="btn btn-edit btn-danger pull-right" onclick="addressOperation('.$address[$i]['addunkid'].',2)" data-title="Delete Address" data-placement="top" data-toggle="tooltip" style="color:#fff; margin-top:0px"><i class="fa fa-trash"></i> Delete</a>
														</div>
														<div class="col-xs-12" style="margin-top:10px">
															<center>
																<a class="btn btn-link" onclick="addressOperation('.$address[$i]['addunkid'].',3)" data-title="Make Default Address" data-placement="top" data-toggle="tooltip" style="margin-top:0px"><i class="fa fa-futbol-o"></i> Make Default</a>
															</center>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>';
				
				}
			}else{
				$addressdata .= '<div class="center-block col-xs-12" style="color:#db2e2e">
									You do not have any address, Please add your address.
								</div>';
			}
		}

		return json_encode($addressdata);
    }

    // DELETE ADDRESS BY ADDUNKID 
    public function deleteAddress(){
    	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

    	if(Auth::check()){

    		$addunkid = Input::get('addid');

    		//FIND, ADDRESS IS DEFAULT OR NOT
    		$existaddquery = DB::table('fd_cusaddress')
    		->select('defaultadd')
    		->where('addunkid', '=', $addunkid)
    		->where('cusunkid', '=', Auth::user()->cusunkid)
    		->first();

    		$existadd = json_decode(json_encode($existaddquery),1);
    		


    		$defaultadd = 0;
    		if($existadd['defaultadd'] == 1){
    			$defaultadd = 1;
    		}

    		//DELETE ADDRESS
    		DB::table('fd_cusaddress')
    		->where('addunkid', '=', $addunkid)
    		->where('cusunkid', '=', Auth::user()->cusunkid)
    		->delete();

    		// IF DEFAULT THEN MAKE ANOTHER AS DEFAULT
    		if($defaultadd == 1){
    			//	GET ANOTHER ADDRESS
	    		$firstadd = DB::table('fd_cusaddress')
	    		->select('addunkid', 'defaultadd')
	    		->where('cusunkid', '=', Auth::user()->cusunkid)
	    		->first();
	    		$decodefirstadd = json_decode(json_encode($firstadd),1);

	    		// MAKE ANOTHER ADDRESS AS DEFAULT
	    		DB::table('fd_cusaddress')
	    		->where('addunkid', '=', $decodefirstadd['addunkid'])
	    		->update([
	    			'defaultadd' => 1
	    			]);
    		}

    	}
    	$addressdata = json_decode($this->displayAddressForUserInfo());

    	return json_encode($addressdata);
    }

    // DELETE ADDRESS BY ADDUNKID 
    public function defaultAddress(){
    	//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

    	if(Auth::check()){
    		$addunkid = Input::get('addid');

    		DB::table('fd_cusaddress')
    		->where('cusunkid', '=', Auth::user()->cusunkid)
    		->update([
    			'defaultadd' => 0
    			]);

    		DB::table('fd_cusaddress')
    		->where('cusunkid', '=', Auth::user()->cusunkid)
    		->where('addunkid', '=', $addunkid)
    		->update([
    			'defaultadd' => 1
    			]);

    	}

    	$addressdata = json_decode($this->displayAddressForUserInfo());

    	return json_encode($addressdata);
    }


    public function updateAddressForm()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$addunkid = Input::get('addid');
		$addinfoenc = DB::table('fd_cusaddress')
				  ->where('addunkid', '='. $addunkid)
				  ->get();
	    $addinfo = json_decode(json_encode($addinfoenc),1);
	    Log::info($addinfo);
		$city = DB::table('cf_city')->get();
		$city = json_decode(json_encode($city),1);
		// Log::info($city[0]);

		$area = DB::table('cf_area')
				->where('cityunkid', '=', $city[0]['cityunkid'])
				->get();

		$area = json_decode(json_encode($area),1);

		// Log::info($area);

		$address = '<div class="modal fade" id="updateaddress">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="ff-btn-modal-close pull-right" data-dismiss="modal">
										<i class="fa fa-times fa-white fa-lg"></i>
									</button>
									<h4 class="modal-title">Add Address</h4>
								</div>
								<div class="modal-body">
									<form name="updateaddress" class="updateaddress">
										<div class="row" style="margin:0px 20px">
											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Name</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<input class="input_text_box" type="text" placeholder="Name..." name="add_name" id="add_name">
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Address</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<input class="input_text_box" type="text" placeholder="Address..." name="add_address" id="add_address">
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">City</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<select name="add_city" id="address_city" class="input_text_box">';
														for($i=0; $i<count($city); $i++){
		$address .=											'<option value="'.$city[$i]['cityunkid'].'">'.$city[$i]['city_name'].'</option>';
														}
		$address .=									'</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Area</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<select name="add_area" id="address_area" class="input_text_box">';
														for($j=0; $j<count($area); $j++)
														{
		$address .=											'<option value="'.$area[$j]['areaunkid'].'">'.$area[$j]['area_name'].'</option>';
														}
		$address .=									'</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-3 col-sm-4 col-xs-12 ff-label">
													<span class="center-block">Pincode</span>
												</div>
												<div class="col-lg-9 col-sm-8 col-xs-12">
													<input class="input_text_box" type="text" placeholder="Pincode..." name="add_pincode" id="add_pincode">
												</div>
											</div>
										</div>
									</form>	
								</div>
								<div class="modal-footer">
									<a class="btn btn-primary btn-lg" id="updateaddress-form">Submit</a>
								</div>
							</div>
						</div>
					</div>


					<script>
					$("#address_city").change(function(){
						var city = $(this).find("option:selected").val();

						var cityarea = $.ajax({
							type: "POST",
							url: "/cityarea",
							data: "_token="+token+"&city="+city,
							dataType: "json",
							timeout: 4000,
							success:function(response){
								$("#address_area").empty();
								$.each(response, function(i,item){
									$("#address_area").append($("<option/>").val(response[i]["areaunkid"]).text(toTitleCase(response[i]["area_name"])));
								});
								cityarea.abort();
							},
							error: function(jqXHR, textStatus, errorThrown) {
						        if(textStatus=="timeout") {
						           $.ajax(this);
						        } 
						    }
						});
					});

					$("#updateaddress-form").click(function(){

						var addressdata = $(".updateaddress").serializeArray();
						addressdata.push({name: "_token", value: token});

						var addaddress = $.ajax({
							type: "POST",
							url: "/address/add",
							data: addressdata,
							dataType: "json",
							timeout: 4000,
							success: function(response){								
								if(response["alert"]){
									location.assign(window.location.pathname);
									// alertline(response["alerttype"],"<b>"+response["message"]+"</b>");
								}else{
									if(response["modal"] == 0){
										$("#updateaddress").modal("hide");
									}
									$("#updateaddress").modal("handleUpdate");
									$(".input_text_box").removeClass("inputerr");
									$(".ff-text-danger").remove();
									$.each(response["message"], function(i,item){
										$("#"+i).addClass("inputerr");
										$("#"+i).after("<div class=\'col-xs-12 ff-text-danger\'>"+item+"</div>");
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
					</script>';

		return json_encode($address);
	}


}
