<?php

	/**
	* 
	*/
	class PartnerPreferences extends Eloquent
	{
		protected $fillable = array('user_id','partner_id','avoid');
		public $timestamps=false;
		protected $table="parnterpreferences";
		public function user(){
			return $this->belongsToMany('User');
		}

		public function partner(){
			return $this->belongsToMany('User');
		}

	}
?>