<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Vend extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $primaryKey = 'vendorunkid';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fd_vendor';


	public function fditems()
	{
		return $this->hasMany('Fditems', 'vendorunkid', 'vendorunkid');
	}

	public function cfitems(){
		return $this->hasManyThrough('Cfitems', 'Fditems', 'vendorunkid', 'itemunkid');
	}

}
