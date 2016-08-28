<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Cfcategory extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $primaryKey = 'categoryunkid';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cf_category';


	public function cfitems(){
		return $this->hasMany('Cfitems', 'categoryunkid', 'categoryunkid');
	}

	

}
