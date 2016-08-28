<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");

class Vendor extends BaseController{
	public function home(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		if(Auth::check()){
			return Redirect::route('admin');
		}
		return View::make('vendor.home2');
	}

	public function reset(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		return View::make('vendor.reset');
	}

	public function signup(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		return View::make('vendor.signup');
	}

	public function signupcall(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		$data = Input::all();
		$type = 'vendor';
		$url = $_SERVER['HTTP_REFERER'];

		if(fnmatch('http://*foodfire*', $url))
		{
			$message = ['email.unique' => 'ER'];
			$validator = Validator::make(Input::all(), [
		        'name' => 'required',
		        'mobile' => 'required',
		        'email' => 'required|email|unique:fd_cus,email,NULL,fd_cus,type,vendor',
		        'password' => 'required',
		        'vendor' => 'required'
		    ], $message);

		    if($validator->fails()){
		    	return $validator->errors();
		    	//return 'failed';
		    }else{
		    	$as = Input::get('password');
		    	$password = Hash::make($as);
		    	$name = Input::get('name');
		    	$email = Input::get('email');
		    	$mobile = Input::get('mobile');
		    	$vendor = Input::get('vendor');

		    	$confirmation_code = str_random(30);

		    	$cus_id_query = DB::select('select get_nextid("fd_cus") as id');
		    	$cus_id_query1 = DB::select('select get_nextid("fd_vendor") as vendorunkid');
		    	Log::info($cus_id_query);
		    	$cus_id = $cus_id_query[0]->id;
		    	$vendorunkid = $cus_id_query1[0]->vendorunkid;
		    	
		    	$query2 = DB::table('fd_vendor')->insert([
		    		'vendorunkid' => $vendorunkid,
		    		'vendor_name' => $vendor
		    		]);
		    	
		    	$query = DB::table('fd_cus')->insert([
		    		'cusunkid' => $cus_id,
		    		'username' => $name,
		    		'email' => $email,
		    		'mob' => $mobile,
		    		'password' => $password,
		    		'conf' => $confirmation_code,
		    		'type' => 'vendor',
		    		'vendorunkid' => $vendorunkid
		    		]);


		    	Mail::send('emails.auth.authemail', array('confirmation_code' => $confirmation_code), function($message) use ($email, $name)
				{
				    $message->to($email, $name)->subject('Authentication!');
				});

		    	if($query){
		    		return json_encode('Registered');
		    	}
		    	return json_encode('Network Problem');
		    	//return json_encode('Registered');
		    }
		}else{
			return 'YOUR URL IS NOT REGISTERED';
		}
	}


	//USER LOGIN CALL 5-JUN 2015
	public function loginUser(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		$loginmessage = [];
		$loginvalidator = Validator::make(Input::all(), [
			"email" => 'required|email',
			"password" => 'required'
			], $loginmessage);

		if($loginvalidator->fails()){
			return $loginvalidator->errors();
		}else{


			$userdata = array(
		        'email'     => Input::get('email'),
		        'password'  => Input::get('password'),
		        'confirmed' => 1,
		        'type' => 'vendor'
		    );

		    if(Auth::attempt($userdata, true)){
		    	return json_encode('success');
		    }else{
		    	if(Auth::validate(array('email' => Input::get('email'), 'password' => Input::get('password'), 'type' => 'vendor'))){
		    		return json_encode("not verify");
		    	}
		    	return json_encode("Fail");
		    }

		}
	}


	//USER EMAIL CONFIRMATION CALL ON SIGN UP
	public function confirm($confirmation_code){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereconf($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->conf = null;
        $user->save();

        Session::flash("conf","Successfully veryfied your email address");

        return Redirect::route('vendor-login');
	}

	//CLICK ON RESET LINK, SHOW NEW PASS FORM
	public function getReset($token = null)
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		if (is_null($token)) App::abort(404);

		// return View::make('password.reset')->with('token', $token);
		// Session::flash("reset-form",$token);

		return View::make('vendor.newpass')->with('resettoken', $token);
	}



	public function postReset()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$credentials1 = Input::only(
			'email', 'password', 'password_confirmation', 'token', 'type'
		);

		$response = Password::reset($credentials1, function($user, $password)
		{
			Log::info($user);
			$user->password = Hash::make($password);

			$user->save();
		});
		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return json_encode('invalid password');
			case Password::INVALID_TOKEN:
				return json_encode('invalid token');
			case Password::INVALID_USER:
				// return Redirect::back()->with('error', Lang::get($response));
				return json_encode('invalid user');

			case Password::PASSWORD_RESET:
				// return Redirect::to('/');
			return json_encode('YES');
		}
	}


	//NOT USED... USED FOR AJAX CALL IN SEARCH PAGE
	public function main(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		$q = Input::get('q');

		// $data = Vendor::where('vendor_name', 'LIKE', $q.'%')->orderBy('vendor_name')->get();

		
		$data = DB::table('fd_vendor AS v')
		   ->leftJoin('fd_rate AS r', 'v.vendorunkid', '=', 'r.vendorunkid')
		   ->select('v.vendorunkid', 'v.vendor_url', 'v.vendor_name', 'v.dp', 'v.area', 'v.city', 'v.price', 'v.veg', 'v.jain', 
		   	'v.swaminarayan', 'v.non_veg', 'v.del_time', 'v.speciality', 
		   	DB::raw('DATEDIFF(NOW(),v.regdate) as born'), 
		   	DB::raw('(select count(*) from fd_rate where vendorunkid=v.vendorunkid and code_id=1) as likes'),
		    DB::raw('(select ROUND(AVG(rate)) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =2) as ratings'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =3) as favourite'),
		    DB::raw('(select COUNT(*) FROM fd_rate WHERE vendorunkid = v.vendorunkid AND code_id =4) as visit')
		    )
		   ->where('vendor_name', 'like', $q.'%')
		   ->distinct()
		   ->get();

		return json_encode($data);
	}
}
