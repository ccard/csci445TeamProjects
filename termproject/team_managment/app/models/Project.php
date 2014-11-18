<?php

	/**
	* 
	*/
	class Project extends Eloquent
	{
		
		protected $table="projects";

		protected $fillable = array('title','company','min','max');
		
		public $timestamps=false;

		public function projectPreferences(){
			return $this->hasMany('ProjectPreferences');
		}

		public function teams(){
			return $this->hasMany('ProjectTeam');
		}

	}
?>