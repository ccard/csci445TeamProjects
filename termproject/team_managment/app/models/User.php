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

	protected $primaryKey='username';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//protected $fillable = array('username','firstname','lastname','majortext','minortext','experience_id','projectpreference_id','pref_part_or_proj','project_id');
	//next line modified by mike	
	protected $fillable = array('username','cwid','firstname','lastname','created_at','updated_at','majortext','minortext','experience','project_preferences_id','pref_part_or_proj','project_team_id');

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
		return $this->belongsTo('ProjectPreferences');
	}

	public function projectTeam(){
		return $this->belongsTo('ProjectTeam');
	}

	/*public function experiences(){
		return $this->hasOne('Experiences');
	}*/

	

}
