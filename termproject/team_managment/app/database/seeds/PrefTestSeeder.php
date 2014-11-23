<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class PrefTestSeeder extends CsvSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function __construct()
	{

		$this->table = 'projectpreferences';
		$this->filename = app_path().'/database/seeds/csvs/preferenceTest.csv';
	}

	public function run()
	{

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();

		//TODO seed from csv file
		parent::run();



	}

}