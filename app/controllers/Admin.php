<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");

class Admin extends BaseController{
	public function home(){
		return View::make('admin.home2');
	}

	public function reset(){
		return View::make('admin.reset');
	}

	public function signup(){
		return View::make('admin.signup');
	}
}