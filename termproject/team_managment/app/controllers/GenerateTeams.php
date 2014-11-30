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
Psuedo algorithm:
-- Phase 1
Go though the user table, one student at a time
get their first, second and third preferences
TODO: later, get their list of partner prefs
Look at first preference. 
Get min and max of first preference.
Count how many times this choice is in projectteams->project_id
if < max, ok to assign, else, look at choice 2, choice 3

-- Phase 2
The instructor will handle projects under min.
-- Phase 3
The instructor will handle the situation were students can't be assigned due to min, max restrictions.
Wrapup: confirm all students are assigned to a team. 
*/

	if(ProjectTeam::count() > 0)  //do a hard reset
	{
		//add a yes / no box: "Are you sure?"
		DB::table('projectteams')->delete(); 
	}
	
	$users = User::where('is_admin','<>','1')->get();
	foreach($users as $user)
	{   //phase 1
		$prefs = $user->projectPreferences;
		$first = $prefs->first_project_id;
		$second = $prefs->second_project_id;
		$third = $prefs->second_project_id;
		$assignedTo = 0;

		$keepLooking = true;
		$likeThisTeam = false;

//See if the first choice is full, then second, then third. 
		$max1 = ($prefs->first_project()->first()->max)-1;
		$max2 = ($prefs->second_project()->first()->max)-1;
		$max3 = ($prefs->third_project()->first()->max)-1;
				
		//get current number of members in the three selected projects...
		$members1 = count(ProjectTeam::where('project_id',$first)->get());
		$members2 = count(ProjectTeam::where('project_id',$second)->get());
		$members3 = count(ProjectTeam::where('project_id',$third)->get());

		// if there anyone I want to work with on that team?
		// 1= true = don't want the person, so find people that I like
		if($user->pref_part_or_proj)
		{
			$partPref = PartenerPreferences::where('user_id',$user->id)->where('avoid','<>',1)->get();

			if(!empty($partPref)) //if(!$partPref->isEmpty())
			{
				foreach($partPref as $pref) {
					//TODO find first people they perfer
					$I_like_list = ProjectTeam::where('user_id', $pref->partner_id)->get();
					// if $aprtPref is in I_prefer, I want to work on that project
					foreach($I_like_list as $member)
					{
						if(count(ProjectTeam::where('project_id', $member->projecct_id)->get()) <= $member->project->max)
						{
							// iThere is someone I like on this team
							$likeThisTeam = true;
							$assignedTo = $member->project_id;
							$keepLooking = false;
						}
					}
					
				}

			}	
		}

		if(!$likeThisTeam){
		//try to assign if the project is not full
			if(($members1 < $max1)&& $keepLooking)  // a switch would be nice...
			{
				$assignedTo = $first;
				$keepLooking = false;	  //break and assign to first choice
			}
		
			if(($members2 < $max2)&& $keepLooking)  
			{
				$assignedTo = $second;
				$keepLooking = false;	
			}
		
			if(($members3 < $max3)&& $keepLooking)  
			{
				$assignedTo = $third;
				$keepLooking = false;	
			}
		}
		
	// if nothing is found... umm... add to unassigned group.			
		if($keepLooking)  
		{
			$assignedTo = $unassigned;
			$keepLooking = false;	
		}

		$projectteam = new ProjectTeam;
		$projectteam->user_id = $user->id;
		$projectteam->project()->associate(Project::find($assignedTo));
		$projectteam->save();
		$user->projectTeam()->associate($projectteam);
		$user->save();
	}

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