<?php
	class PetsSeeder extends Seeder {
		/**
		* Run the database seeds.
		*
		* @return void
		*/
		public function run()
		{
			DB::table('pets')->insert(array(
				array('name'=>"Pumpkin",'age'=>7,'specie_id'=>1),
				array('name'=>"Fido",'age'=>3,'specie_id'=>2),
				array('name'=>"Oliver",'age'=>12,'specie_id'=>1),
				array('name'=>"Snowy",'age'=>8,'specie_id'=>1),
				array('name'=>"Rover",'age'=>8,'specie_id'=>2),
				array('name'=>"Laddie",'age'=>6,'specie_id'=>2),
				array('name'=>"Daffney",'age'=>2,'specie_id'=>3),
			));
		}
	}
?>