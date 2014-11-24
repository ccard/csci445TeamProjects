<?php

class GenerateTeams extends BaseController {

	public function generateTeams()
	{
		//TODO Place table generation code calls here
		// things I can access from models\User.php and projects.php:
		$uCount = User::count();  
		$outcome = 'Success';      
		$projID = 1;
		$userID = 1;
		$prefs;
		// need a array to keep track of students assigned to each project - or just use table
		
/* =======================================================================
The psuedo algorithm, first thoughts:
The student users are already un-sorted.
It would be more efficent if projects were an outer loop, but if students is the outer loop,
we should have more randomness.
-- Phase 1
Go though the user table, one student at a time
get their first, second and third preferences
TODO: later, get their list of partner prefs
Look at first preference. 
Get min and max of first preference.
Count how many times this choice is in projectteams->project_id
if < max, ok to assign, else, look at choice 2, choice 3

-- Phase 2
After first pass through the student list, check projectteams and see if any are under min.
while there are projects that have been chosen but are under min:
  loop thru projects. for each project, get min and max:
  	loop through projectteams and count the user_id per projectid
  		if a project is under min:
  		   loop through ProjectPreferences, geez!================================
  Make a list of project IDs that are under min?
  For the projects under min:
  get the projectteams->user_id. while they exist, or something like that.
  For the user ID, get 1, 2, 3rd choices again.
  See if the next choice is available
-- Phase 3
Handle the situation were students can't be assigned due to min, max restrictions.
Wrapup: confirm all students are assigned to a team. Confirm mins and maxes.
*/
	$userID = 1;
	if(ProjectTeam::count() > 0)
	{
		DB::table('projectteams')->delete(); 
	}
	do
	{   //phase 1
		$prefs = DB::table('ProjectPreferences')->where('user_id', $userID)->first();
		$first = $prefs->first_project_id;
		$second = $prefs->second_project_id;
		$third = $prefs->second_project_id;

		//TODO: see if the first choice is full, then second, then third.

		//TODO: Make sure we are not over max on the chosen project  

		//test, see if we can write anything
		DB::table('projectteams')->insert(array(
			array('user_id'=>$userID,'project_id'=>$first),
		));   //insertions work

		$userID = $userID + 1;
	} while ($userID <= $uCount);

	//dd($prefs->first_project_id); //should be 21 if using PrefTestSeeder
	//dd(ProjectTeam::count());
	//DB::table('projectteams')->delete(); 
	//dd(ProjectTeam::count());
	
				




	//Then redirect to home
	return Redirect::to('home')->with('message', $outcome .' , processed '. $uCount . ' students.');
	}

	public function changePassword(){
		
	}

	public function resetPassword(){
		
	}

	public function deleteUser(){
		
	}

	public function changeName(){
		
	}

	public function changeMajor(){
		
	}

	public function changeExp(){
		$userid = Input::get('userid');
		$user = NULL;

		$experience = Input::get('expirencetext');

		//Change the user experience text field

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changeProjPref(){
		
	}

	public function changePartPref(){
		
	}

	public function adminAddMember(){
		
	}

	public function deleteProject(){
		
	}

}