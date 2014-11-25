<?php

class GenerateTeams extends BaseController {

	public function generateTeams()
	{
		//TODO Place table generation code calls here
		$uCount = User::count(); 
		$unassigned = Project::count();  //project number for students that need Instructor assignment
		$outcome = 'Success';      
		$projID = 1;
		$userID = 1;
		$prefs;

		
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
	if(ProjectTeam::count() > 0)  //do a hard reset
	{
		//add a yes / no box: "Are you sure?"
		DB::table('projectteams')->delete(); 
	}
	
	do
	{   
		$prefs = DB::table('projectpreferences')->where('user_id', $userID)->first();
		$first = $prefs->first_project_id;
		$second = $prefs->second_project_id;
		$third = $prefs->second_project_id;
		$assignedTo = 0;
		$keepLooking = true;  

		//Get maximums of the three choices.... 
		$max1 = DB::table('projects')->where('id',$first)->first()->max;
		$max2 = DB::table('projects')->where('id',$second)->first()->max;
		$max3 = DB::table('projects')->where('id',$third)->first()->max;
		
		//Get the list of members already assigned to each project...
		$mem1 = DB::table('projectteams')->where('project_id',$first)->get();
		$mem2 = DB::table('projectteams')->where('project_id',$second)->get();
		$mem3 = DB::table('projectteams')->where('project_id',$third)->get();

		//try to assign if the project is not full
		if((count($mem1) < $max1)&& $keepLooking)  // a switch would be nice...
		{
			$assignedTo = $first;
			$keepLooking = false;	  //break and assign to first choice
		}
		
		if((count($mem2) < $max2)&& $keepLooking)  
		{
			$assignedTo = $second;
			$keepLooking = false;	
		}
		
		if((count($mem3) < $max3)&& $keepLooking)  
		{
			$assignedTo = $third;
			$keepLooking = false;	
		}
		
	// if nothing is found... umm... add to unassigned group.			
		if($keepLooking)  
		{
			$assignedTo = $unassigned;
			$keepLooking = false;	
		}
		
		//write assignment
		DB::table('projectteams')->insert(array(
			array('user_id'=>$userID,'project_id'=>$assignedTo),
		));   //insertions work

		$userID = $userID + 1;
	} while ($userID <= $uCount);

	//see how many students are in the unassigned group
	$free = DB::table('projectteams')->where('project_id',$unassigned)->get();

	

	//Then redirect to home
	return Redirect::to('home')->with('message', $outcome .' , processed '. $uCount . ' students. '
	 . ($uCount - count($free)) . ' are assigned teams. ' . count($free) . ' student(s) need assistance.');

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