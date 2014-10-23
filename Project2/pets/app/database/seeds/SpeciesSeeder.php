<?php
	class SpeciesSeeder extends Seeder {
		/**
		* Run the database seeds.
		*
		* @return void
		*/
		public function run()
		{
			DB::table('species')->insert(array(
				array('id'=>1,'name'=>"cat"),
				array('id'=>2,'name'=>"dog"),
				array('id'=>3,'name'=>"duck"),
			));
		}
	}
?>