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
		$userid = Input::get('userid');
		$user = NULL; //TODO: find the user based off of the userid

		//TODO: Check the old password against the stored password using hash check
		// Verify that the new password and the confirmation of the new password match
		// if the correct old password is passed in is correct then change the password
		//  remember to hash the new password

		$old_pass = Input::get('password');
		$new_pass = Input::get('newpassword');
		$confirm_pass = Input::get('confirmpassword');

		// check that the old password is corrrect using Hash::check($old_pass,$user->password)
		// if thats the case then check if the new_pass and confirm_pass are the same
		// if the new and confirm password are correct hash the new password and save it to the user 

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function resetPassword(){
		$userid = Input::get('userid');
		$user = NULL;

		if(Auth::user()->isAdmin()){
		//reset the the password to the hash of the users cwid
			return Redirect::back()->with('message','Password reset');
		} else {
			return Redirect::back()->with('error','Your not authorized');
		}
	}

	public function deleteUser(){
		$userid = Input::get('userid');
		$user = NULL; // query db for user

		//if Auth::user() is the admin then delete &user from the database tables
		//ProjectTeams ParnterPreferences ProjectPreferences Users etc..

		return Redirect::back()->with('message','User deleted');
	}

	public function changeName(){
		$userid = Input::get('userid');
		$user = NULL;

		$firstname = Input::get('firstname');
		$lastname = Input::get('lastname');

		//change the users first and last name

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changeMajor(){
		$userid = Input::get('userid');
		$user = NULL;

		$majortext = Input::get('majortext');
		$minortext = Input::get('minortext');

		//Change the users major and minor

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changeExp(){
		$userid = Input::get('userid');
		$user = NULL;

		$experience = Input::get('expirencetext');

		//Change the user experience text field

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changeProjPref(){
		$userid = Input::get('userid');
		$user = NULL;

		$first_project_id = Input::get('first_project_id');
		$second_project_id = Input::get('second_project_id');
		$third_project_id = Input::get('first_project_id');

		//Change the users first second and third project preferences

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changePartPref(){
		$userid = Input::get('userid');
		$user = NULL;

		$pref_partners = Input::get('pref_partner');
		$nopref_partners = Input::get('no_pref_partner');

		//Save the new project preferences and delete the old if they removed any

		$user->pref_part_or_proj = Input::get('pref_part_or_proj');

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function adminAddMember(){
		$projid = Input::get('projid');

		$userid = Input::get('user_id');

		//add the new user to the projid in the projectteams

		return Redirect::to('home/editteam/'.$projid)->with('message','Success '.$projid);
	}

	public function deleteProject(){
		if(Auth::user()->isAdmin()) {
			$projid = Input::get('projid');
			//delete the project from the database

			return Redirect::back()->with('message','The project was deleted');
		} else {
			return Redirect::back();
		}
	}

}