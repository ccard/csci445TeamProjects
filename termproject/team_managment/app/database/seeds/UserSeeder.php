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
 		$this->table = 'users';
		$this->filename = app_path().'/database/seeds/csvs/students.csv';
	}

	public function run()
	{

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();

		$date = new \DateTime;

		DB::table('users')->insert(array(
			array('username'=>'admin@admin.com','cwid'=>'admin','firstname'=>'Cynthia','lastname'=>'Rader','is_admin'=>true),
		));


		//TODO seed from the csv file
		parent::run();

		foreach (DB::table("users")->get() as $user) {
			DB::table("users")
				->where('id',$user->id)
				->update(array("password"=>Hash::make($user->cwid)));
		}

	}

}