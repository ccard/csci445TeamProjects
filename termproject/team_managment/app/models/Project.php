<?php

	/**
	* 
	*/
	class ProjectTeam extends Eloquent
	{
		protected $fillable = array('title','company');
		public $timestamps=false;
		public function rojectPreferences(){
			return $this->belongsToMany('ProjectPreferences');
		}

		public function teams(){
			return $this->hasMany('ProjectTeam');
		}

	}
?>