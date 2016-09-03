<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");
class Login extends BaseController{

	//USER REGISTRATION CALL
	public function newReg()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		$data = Input::all();
		$type = 'cus';
		$url = $_SERVER['HTTP_REFERER'];

		$tbl_cus = 'fd_cus';

		if(fnmatch('http://*foodfire*', $url))
		{
			//return $data;
			$message = ['email.unique' => 'ER'];
			$validator = Validator::make(Input::all(), [
		        'name' => 'required',
		        'mobile' => 'required|min:6',
		        'email' => 'required|email|unique:fd_cus,email,NULL,fd_cus,type,cus',
		        'password' => 'required'
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
		    	$userimg = 'http://www.foodfire.in/public/images/blank_user.png';

		    	$confirmation_code = str_random(30);

		    	$cus_id_query = DB::select('select get_nextid("fd_cus") as id');
		    	$cus_id = $cus_id_query[0]->id;
		    	$query = DB::table($tbl_cus)->insert([
		    		'cusunkid' => $cus_id,
		    		'username' => $name,
		    		'email' => $email,
		    		'mob' => $mobile,
		    		'userimg' => $userimg,
		    		'password' => $password,
		    		'conf' => $confirmation_code,
		    		'type' => 'cus'
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
		//$host = $_SERVER['HTTP_HOST'];
		//return $url;	
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
		        'type' => 'cus'
		    );

		    if(Auth::attempt($userdata, true)){
		    	return json_encode(Auth::user()->username);
		    }else{
		    	if(Auth::validate(array('email' => Input::get('email'), 'password' => Input::get('password')))){
		    		return json_encode("not verify");
		    	}
		    	return json_encode("Fail");
		    }

		}
	}


	//USER LOGOUT CALL 6-JUN 2015
	public function logoutUser(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		Auth::logout();
		return json_encode('Logged out');
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

        return Redirect::route('index');
	}

}