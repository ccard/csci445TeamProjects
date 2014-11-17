<?php

	/**
	* 
	*/
	class ProjectTeam extends Eloquent
	{
		protected $fillable = array('user_id','project_id');
		public $timestamps=false;
		protected $table="projectteams";
		public function user(){
			return $this->hasMany('User');
		}

		public function project(){
			return $this->belongsTo('Project');
		}

	}
?>