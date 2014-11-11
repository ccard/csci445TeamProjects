<?php

	/**
	* 
	*/
	class Project extends Eloquent
	{
		protected $fillable = array('title','company');
		public $timestamps=false;
		public function projectPreferences(){
			return $this->belongsToMany('ProjectPreferences');
		}

		public function teams(){
			return $this->hasMany('ProjectTeam');
		}

	}
?>