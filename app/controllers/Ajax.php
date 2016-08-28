<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");
class Ajax extends BaseController{

	public function searchAuto()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		//session_write_close();
		$data = Input::all();
		$url = $_SERVER['HTTP_REFERER'];

		$tbl_search = 'fd_search';

		
		if(fnmatch('http://*foodfire.*', $url))
		{
			$data = Input::get('q');
			// Log::info($data);
			$name = DB::table($tbl_search)->select('res')->where('res', 'LIKE', $data.'%')->orderBy('res')->take(5)->get();
			$i=0;
			foreach ($name as $item)
			{
			    echo ucwords(strtolower($item->res))."\n";
			}

		}else{
			return 'YOUR URL IS NOT REGISTERED';
		}
	}



	// CURRENTLY NOT IN USE
	public function recipe()
	{
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		$url = $_SERVER['HTTP_REFERER'];

		$tbl_data = 'cf_data';
		if(fnmatch('http://*foodfire.*', $url))
		{
			
			// Log::info($data);
			$code = Input::get('code');
			$col = Input::get('col');
			$name = DB::table($tbl_data)->select('code')->where('code_id', $code)->where('col', $col)->get();
			//Log::info('HERE ANSWER',$name);
			$i=0;
			foreach ($name as $item)
			{
			    echo $item->code;
			}
			

		}else{
			return 'YOUR URL IS NOT REGISTERED';
		}
	}

	// CURRENTLY NOT IN USE
	public function recipee(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);
		// echo 'as';
		echo URL::full();
	}

}
