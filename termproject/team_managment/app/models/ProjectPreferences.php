<?php

	/**
	* 
	*/
	class ProjectPreferences extends Eloquent
	{
		protected $fillable = array('user_id','first_project_id','second_project_id','third_project_id');
		public $timestamps=false;
		protected $table="projectpreferences";
		public function user(){
			return $this->hasMany('User');
		}

		public function first_project(){
			return $this->belongsTo('Project');
		}

		public function second_project(){
			return $this->belongsTo('Project');
		}

		public function third_project(){
			return $this->belongsTo('Project');
		}
	}
?>