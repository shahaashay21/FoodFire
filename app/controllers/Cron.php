<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");

class Cron extends BaseController{

    //FETCH VALUE TO RENDER VENDOR IN SEARCH PAGE
    public function main(){
       return View::make('cron');
    }
}