<?php


class VendorDashboard extends BaseController{

	public function dashboard(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		if(Auth::check()){
			return View::make('vendor.layout');
		}else{
			return Redirect::route('vendor-login');
		}
	}
}