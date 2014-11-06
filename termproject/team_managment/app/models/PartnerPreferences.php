<?php

	/**
	* 
	*/
	class PartnerPreferences extends Eloquent
	{
		protected $fillable = array('user_id','partner_id');
		public $timestamps=false;
		public function user(){
			return $this->belongsToMany('User');
		}

		public function partner(){
			return $this->belongsToMany('User');
		}

	}
?>