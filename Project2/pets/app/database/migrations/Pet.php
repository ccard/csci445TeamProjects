<?php

	/**
	* 
	*/
	class Pet extends Eloquent
	{
		protected $fillable = array('name','age','species_id');
		public $timestamps=false;
		public function specie(){
			return $this->belongsTo('Specie');
		}

	}
?>