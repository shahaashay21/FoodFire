<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");

use \Address;

class Users extends BaseController{


	public function home(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		return View::make('user/users');
	}


	public function profile(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$userinfo = DB::table('fd_cus')
					->select('username', 'email', 'mob', 'gender', 'birthday', 'userimg')
					->where('cusunkid', '=', Auth::user()->cusunkid)
					->get();

		$addressobj = new Address();
		$addressdata = json_decode($addressobj->displayAddressForUserInfo());

		return View::make('user/profile')
				->with('userinfo', $userinfo)
				->with('address', $addressdata);
	}


	public function orders(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		return View::make('user/orders');
	}

	public function reviews(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		return View::make('user/reviews');
	}
}