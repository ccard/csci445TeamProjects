<?php

	/**
	* 
	*/
	class Experiences extends Eloquent
	{
		protected $fillable = array('experience');
		public $timestamps=false;
		
		protected $table="experiences";
	}
?>