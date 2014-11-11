<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function getAuthIdentifier() {
		return $this->getKey();
	}

	public function getAuthPassword() {
		return $this->password;
	}

	public function isAdmin(){
		return $this->is_admin;
	}

	public function partnerPreferences(){
		return $this->belongsToMany('PartnerPreferences');
	}

	public function projectPreferences(){
		return $this->belongsToMany('ProjectPreferences');
	}

	public function project(){
		return $this->belongsTo('ProjectTeam');
	}

	public function experiences(){
		return $this->hasOne('Experiences');
	}

}
