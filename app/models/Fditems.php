<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Fditems extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $primaryKey = 'id';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fd_items';


	public function vend(){
		return $this->belongsTo('Vend', 'vendorunkid', 'vendorunkid');
	}

	public function cfitems(){
		return $this->hasOne('Cfitems', 'itemunkid', 'itemunkid');
	}

}
