<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class UserSeeder extends CsvSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function __construct()
	{
        //hashable(string password); // added by Mike, but probably not needed
		$this->table = 'users';
		$this->filename = app_path().'/database/seeds/csvs/students.csv';
	}

	public function run()
	{

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();

		$date = new \DateTime;
		//DB::table('users')->insert(array(array('username'=>'admin@admin.com', 'password'=>'admin','firstname'=>'Cynthia','lastname'=>'Rader','created_at'=>$date,'updated_at'=>$date)));
		DB::table('users')->insert(array(
			array('username'=>'admin@admin.com', 'password'=>'admin','firstname'=>'Cynthia','lastname'=>'Rader','created_at'=>$date,'updated_at'=>$date,'is_admin'=>1),
		));


		//TODO seed from the csv file
		parent::run();



	}

}