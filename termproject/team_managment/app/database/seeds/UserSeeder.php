<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new \DateTime;
		DB::table('users')->insert(array(array('username'=>'admin@admin.com', 'password'=>'admin','firstname'=>'Cynthia','lastname'=>'Rader','created_at'=>$date,'updated_at'=>$date)));

		//TODO seed from the csv file
	}

}