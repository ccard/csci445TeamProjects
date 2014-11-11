<?php

	/**
	* 
	*/
	class ProjectPreferences extends Eloquent
	{
		protected $fillable = array('user_id','first_project_id','second_project_id','third_project_id');
		public $timestamps=false;
		public function user(){
			return $this->belongsToMany('User');
		}

		public function project(){
			return $this->belongsToMany('Project');
		}

	}
?>