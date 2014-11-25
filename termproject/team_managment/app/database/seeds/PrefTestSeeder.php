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


		$prefs = ProjectPreferences::all();
		foreach($prefs as $pref){
			$user = User::where('id',$pref->user_id)->first();
			
			$proj1 = Project::find($pref->first_project_id);
			$proj2 = Project::find($pref->second_project_id);
			$proj3 = Project::find($pref->third_project_id);
			$tmppref = new ProjectPreferences;
			$tmppref->user_id = $user->id;
			$tmppref->first_project()->associate($proj1);
			$tmppref->second_project()->associate($proj2);
			$tmppref->third_project()->associate($proj3);
			$pref->delete();
			$tmppref->save();

			$user->projectPreferences()->associate($tmppref);
			$user->save();
		}
	}

}