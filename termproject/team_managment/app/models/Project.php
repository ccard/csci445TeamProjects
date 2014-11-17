<?php

	/**
	* 
	*/
	class Project extends Eloquent
	{
		protected $fillable = array('title','company');
		public $timestamps=false;

		protected $table="projects";

		public function projectPreferences(){
			return $this->hasMany('ProjectPreferences');
		}

		public function teams(){
			return $this->hasMany('ProjectTeam');
		}

	}
?>