	<?php
	 use Illuminate\Support\MessageBag;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*------------------------------------------------------------------------
 Get routes
*/
Route::get('/', function()
{
	if(Auth::check()){
		return Redirect::to('home');
	} else {
		return Redirect::to('login');
	}
});

Route::get('login', function(){
	return View::make('team_managment.login');
});

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/')
		->with('message', 'You are now logged out.');
});

Route::post('login',function(){
	//dd(Input::only('username','password'));
	if(Auth::attempt(Input::only('username','password'), true)){
		return Redirect::intended('/');
	} else {
		return Redirect::back()->withInput()->with('error',"Invalid credentials!");
	}
});

Route::group(array('before'=>'auth'), function(){
Route::get('home', function() {
	if (Auth::user()->isAdmin()){

		$users = User::count(); //the number of users in the system
		$emails = '';//populate with list of emails
		$projects = Project::count(); //the number of projects in the system
		$projectteams = array(); //Project teams is in the following format array('projectid'=>array('projname'=>'projname', 'members'=>array('email'=>'name')))
		$unassigned_user_count=count(User::whereNull('project_team_id')->get());
		$unassigned_user_emails=User::whereNull('project_team_id')->get()->lists('username');

		foreach($unassigned_user_emails as $email) {
			$emails.=$email.',';
		}

		$project_teams = ProjectTeam::all();
		foreach($project_teams as $project) {
			$user = User::where('id', $project->user_id)->first();
			if(empty($user)) {
				continue;
			} else if(array_key_exists($project->project_id, $projectteams)) {
				$projectteams[$project->project_id]['members'][$user->username] = $user->lastname.'-'.$user->firstname;
				$emails.=$user->username.',';
			} else {
				
				$projectteams[$project->project_id] = ['projname' => $project->project->title, 'members' => [$user->username => $user->lastname.'-'.$user->firstname], 'projmin'=> $project->project->min, 'projmax'=>$project->project->max];

				$emails.=$user->username.',';
			}
		}

		return View::make('team_managment.adminhome')->with('users',$users)->with('projects',$projects)->with('projectteams', $projectteams)->with('emails',$emails)->with('unassignedusers', $unassigned_user_count);
	} else {
		//dd(is_null(Auth::user()->projectTeam));
		//If the user has no project preferences then they must be redirected to the firstogin page
		if(!is_null(Auth::user()->project_preferences_id)){
			//$project = array(); //TODO: replace this with a query to database to get project name and all associted student names and emails
			$project = array();
			if(!is_null(Auth::user()->projectTeam)){
				$project_team_id = Auth::user()->projectTeam->project_id;
				$project_members = ProjectTeam::where('project_id', $project_team_id)->get()->lists('user_id');
				$project_name = Auth::user()->projectTeam->project->title;
				//in the form of array('projname'=>"name", 'members'=>array('email'=>"name"))
				$project = [
					'projname' => $project_name,
					'members' => array(),
				];
				foreach($project_members as $member) {
					$user = User::where('id',$member)->first();
					$project['members'][$user->username] = $user->lastname.'-'.$user->firstname;
				}
			}

			return View::make('team_managment.userhome')->with('user',Auth::user())->with('project',$project);
		} else {
			return Redirect::to('home/firstlogin');
		}
	}
});

Route::get('home/firstlogin', function(){
	//Pass in user information to the form must be TODO make sure this works
	if(Session::has('error')) {
		if(Session::has('errors')){
			return View::make('team_managment.firsttimelogin')->with('user',Auth::user())->with('method','post')->with('error', Session::get('error'))->with('errors',Session::get('errors'));
		} else {
			return View::make('team_managment.firsttimelogin')->with('user',Auth::user())->with('method','post')->with('error', Session::get('error'))->with('errors',new MessageBag);
		}
	} else {
		return View::make('team_managment.firsttimelogin')->with('user',Auth::user())->with('method','post')->with('errors',new MessageBag);
	}	
});

Route::get('home/accountinfo', function(){
	 if (Auth::user()->isAdmin()) {
		$user = Auth::user();
		if(Session::has('message')){
			return View::make('team_managment.adminaccount')->with('user',$user)
				->with('message',Session::get('message'))
	 			->nest('passchange','modal_views.passmodal',array('user'=>$user))
				->nest('namechange','modal_views.namechangmodal',array('user'=>$user));
		} elseif(Session::has('error')){
			return View::make('team_managment.adminaccount')->with('user',$user)
				->with('error',Session::get('error'))
	 			->nest('passchange','modal_views.passmodal',array('user'=>$user))
				->nest('namechange','modal_views.namechangmodal',array('user'=>$user));
		} else {
	 		return View::make('team_managment.adminaccount')->with('user',$user)
	 			->nest('passchange','modal_views.passmodal',array('user'=>$user))
				->nest('namechange','modal_views.namechangmodal',array('user'=>$user));
		}
	} else {

		$user = Auth::user();
		
		//populates options
		$projects = Project::all();
		$projectoptions = array_combine($projects->lists('id'), $projects->lists('title'));

		$users = User::where('id', '<>', $user->id)->where('is_admin', '<>', 1)->get();
		$firstnames = $users->lists('firstname');
		$lastnames = $users->lists('lastname');
		$arr = array_map(function($str1, $str2){ return $str1." ".$str2;}, $firstnames, $lastnames);
		$partneroptions = array_combine($users->lists('id'), $arr);

		$perferedchoice = PartnerPreferences::where('user_id', '=', $user->id)->where('avoid', '<>', 1)->get()->lists('partner_id');
		$avoidchoice = PartnerPreferences::where('user_id', '=', $user->id)->where('avoid', '=', 1)->get()->lists('partner_id');
		if(Session::has('message')){
			return View::make('team_managment.useraccount')->with('user',$user)
				->with('partneroptions',$partneroptions)
				->with('perferedchoice',$perferedchoice)
				->with('avoidchoice',$avoidchoice)
				->with('projoptions',$projectoptions)
				->with('message',Session::get('message'))
				->nest('passchange','modal_views.passmodal',array('user'=>$user))
				->nest('namechange','modal_views.namechangmodal',array('user'=>$user))
				->nest('degchange','modal_views.degchangemodal',array('user'=>$user))
				->nest('expchange','modal_views.expchangemodal',array('user'=>$user))
				->nest('projprefchange','modal_views.projprefchangemodal',array('user'=>$user,'projoptions'=>$projectoptions))
				->nest('partprefchange','modal_views.partprefchangemodal',array('user'=>$user,'partneroptions'=>$partneroptions, 'perferedchoice'=>$perferedchoice, 'avoidchoice'=>$avoidchoice));
		} elseif(Session::has('error')){
			return View::make('team_managment.useraccount')->with('user',$user)
				->with('partneroptions',$partneroptions)
				->with('perferedchoice',$perferedchoice)
				->with('avoidchoice',$avoidchoice)
				->with('projoptions',$projectoptions)
				->with('error',Session::get('error'))
				->nest('passchange','modal_views.passmodal',array('user'=>$user))
				->nest('namechange','modal_views.namechangmodal',array('user'=>$user))
				->nest('degchange','modal_views.degchangemodal',array('user'=>$user))
				->nest('expchange','modal_views.expchangemodal',array('user'=>$user))
				->nest('projprefchange','modal_views.projprefchangemodal',array('user'=>$user,'projoptions'=>$projectoptions))
				->nest('partprefchange','modal_views.partprefchangemodal',array('user'=>$user,'partneroptions'=>$partneroptions, 'perferedchoice'=>$perferedchoice, 'avoidchoice'=>$avoidchoice));
		} else {
				return View::make('team_managment.useraccount')->with('user',$user)
				->with('partneroptions',$partneroptions)
				->with('projoptions',$projectoptions)
				->with('perferedchoice',$perferedchoice)
				->with('avoidchoice',$avoidchoice)
				->nest('passchange','modal_views.passmodal',array('user'=>$user))
				->nest('namechange','modal_views.namechangmodal',array('user'=>$user))
				->nest('degchange','modal_views.degchangemodal',array('user'=>$user))
				->nest('expchange','modal_views.expchangemodal',array('user'=>$user))
				->nest('projprefchange','modal_views.projprefchangemodal',array('user'=>$user,'projoptions'=>$projectoptions))
				->nest('partprefchange','modal_views.partprefchangemodal',array('user'=>$user,'partneroptions'=>$partneroptions, 'perferedchoice'=>$perferedchoice, 'avoidchoice'=>$avoidchoice));
		}
	}
});

Route::get('home/editteam/{projid}', function($projid) {
	if(Auth::user()->isAdmin()){

	//	$projectteam = array('projid'=>'1','projname'=>'test', 'users'=>array('12'=>array('name'=>'chris','email'=>'test@aol.com'))); //of the form ('projid'=>id, 'projname'=>'projname', 'users'=>array('userid'=>array('name'=>'name', 'email'=>'email')...))
		$rawteam = ProjectTeam::where('project_id', $projid)->get();
		$projectteam = [
			'projid' => $projid,
			'projname' => $rawteam->first()->project->title,
			'users' => array()
		];
		foreach($rawteam as $teammember) {
			$user = $teammember->user()->first();
			if(is_null($user)){
				dd($projectteam);
			}
			$projectteam['users'][$user->id] = [
				'name' => $user->lastname.'-'.$user->firstname,
				'email' => $user->username
			];
		}

		$nonassignedusers = User::whereNull('project_team_id')->where('is_admin','<>','1')->get();
		$firstnames = $nonassignedusers->lists('firstname');
		$lastnames = $nonassignedusers->lists('lastname');
		$arr = array_map(function($str1, $str2){ return $str1." ".$str2;}, $firstnames, $lastnames);
		$nonassignedusers = array_combine($nonassignedusers->lists('id'), $arr);
		//$nonassignusers = array_combine([1],['user']); //combined list of users where the first part is the user id and the second part is the user name
		if(Session::has('message')){
			return View::make('team_managment.editteam')->with('projectteam',$projectteam)->with('message',Session::get('message'))
			->nest('adminaddteam','modal_views.adminaddteammodal',array('projid'=>$projid,'nonassignusers'=>$nonassignedusers));
		} elseif (Session::has('error')) {
			return View::make('team_managment.editteam')->with('projectteam',$projectteam)->with('error',Session::get('error'))
			->nest('adminaddteam','modal_views.adminaddteammodal',array('projid'=>$projid,'nonassignusers'=>$nonassignedusers));
		} else {
			return View::make('team_managment.editteam')->with('projectteam',$projectteam)
			->nest('adminaddteam','modal_views.adminaddteammodal',array('projid'=>$projid,'nonassignusers'=>$nonassignedusers));
		}
	} else {
		return Redirect::back();
	}
});	

Route::get('users/{id}/info', function($id){
	if(Auth::user()->isAdmin()){
		$method = 'get'; // to just view the information
		$user = User::where('id','=',$id)->first();//replace with a query for the user id
		
		//populates options
		$projects = Project::all();
		$projectoptions = array_combine($projects->lists('id'), $projects->lists('title'));

		$users = User::where('id', '<>', $user->id)->where('is_admin', '<>', 1)->get();
		$firstnames = $users->lists('firstname');
		$lastnames = $users->lists('lastname');
		$arr = array_map(function($str1, $str2){ return $str1." ".$str2;}, $firstnames, $lastnames);
		$partneroptions = array_combine($users->lists('id'), $arr);

		$perferedchoice = PartnerPreferences::where('user_id', '=', $user->id)->where('avoid', '<>', 1)->get()->lists('partner_id');
		$avoidchoice = PartnerPreferences::where('user_id', '=', $user->id)->where('avoid', '=', 1)->get()->lists('partner_id');

		return View::make('team_managment.useraccount')->with('method',$method)
		->with('user',$user)
		->with('projoptions',$projectoptions)
		->with('partneroptions',$partneroptions)
		->with('perferedchoice',$perferedchoice)
		->with('avoidchoice',$avoidchoice);
	} else {
		return Redirect::back();
	}
});

/*------------------------------------------------------------------------
 Post routes
 */
Route::post('home/firstlogin/{id}', function($id){


	//rules
	$rules = array(
		'majortext'=>'Required|Min:3',
		'minortext'=>'Required|Min:3',
		'first_project_id'=>'different:second_project_id',
		'first_project_id'=>'different:third_project_id',
		'second_project_id'=>'different:first_project_id',
		'second_project_id'=>'different:third_project_id',
		'third_project_id'=>'different:second_project_id',
		'third_project_id'=>'different:first_project_id'
		);
	$messages = array(
		'first_project_id.different'=>'The first project choice must be different from the second and third choice',
		'second_project_id.different'=>'The second project choice must be different from the first and third choice',
		'third_project_id.different'=>'The third project choice must be different from the second and first choice'
		);
	$validator= Validator::make(Input::all(),$rules,$messages);
	if ($validator->passes()) {
		$pref_partners = Input::get('pref_partner');
		$nopref_partners = Input::get('no_pref_partner');
		$is_valid = true;
		foreach ($pref_partners as $pref_check) {
			if(in_array($pref_check, $nopref_partners)){
				$is_valid = false;
				break;
			}
		}
		if($is_valid){
			// query = update users set (majortext, minortext, experienceid, projprefid, pref_partor_proj, )
			$user = Auth::user();
			//$user->firstname = Input::
			$project_preferences = new ProjectPreferences;
			$project_preferences->user_id = $user->id;
			$project_preferences->first_project_id = Input::get("first_project_id");
			$project_preferences->second_project_id = Input::get("second_project_id");
			$project_preferences->third_project_id = Input::get("third_project_id");
			$project_preferences->save();
			$user->projectPreferences()->associate($project_preferences);
			//dd($user->projectPreferences()->first_project());
			$experiences = new Experiences;
	
			//dd(Input::get('expirencetext'));
	
	
			//dd($user->experiences()->save($experiences));
	
			$user->majortext = Input::get('majortext');
			$user->minortext = Input::get('minortext');
			$user->experience = Input::get('expirencetext');
			$user->pref_part_or_proj = Input::get('pref_part_or_proj');
		
			$pref_partners_array = array();
			foreach($pref_partners as $pref_partner) {
				$partner_preferences = new PartnerPreferences;
				$partner_preferences->user_id = $user->id;
				$partner_preferences->partner_id = $pref_partner;
				$partner_preferences->avoid = false;
				$partner_preferences->save();
			}
	
			$nopref_partners_array = array();
			foreach($nopref_partners as $nopref_partner) {
				$nopartner_preferences = new PartnerPreferences;
				$nopartner_preferences->user_id = $user->id;
				$nopartner_preferences->partner_id = $nopref_partner;
				$nopartner_preferences->avoid = true;
				$nopartner_preferences->save();
			}
	
			if($user->save()) { 
				return Redirect::to('home')->with('message', 'Your info has been saved.');
			} else {
				return Redirect::back()->withInput()->with('error', 'Your info has not been saved.');
			}
		} else {
			return Redirect::back()->withInput()->with('error', 'You cannont perfer and avoid a person.');	
		}
	}else{
		return Redirect::back()->withInput()->with('error', 'Some fields are filled incorrectly')->with('errors',$validator->messages());
	}
});

Route::get('home/accountinfo/managestudents', function() {
 	if(Auth::user()->isAdmin()){
 		$userInfo = User::where('id','<>',Auth::user()->id)->orderBy('lastname')->get();
 		if(Session::has('message')){
 			return View::make('team_managment.managestudents')
 			->with('userInfo', $userInfo)
 			->with('message',Session::get('message'))
 			->nest('addstudent','modal_views.addstudentmodal');
 		} elseif(Session::has('error')){
 			return View::make('team_managment.managestudents')
 			->with('userInfo', $userInfo)
 			->with('error',Session::get('error'))
 			->nest('addstudent','modal_views.addstudentmodal');
 		} else {
 			return View::make('team_managment.managestudents')
 			->with('userInfo', $userInfo)
 			->nest('addstudent','modal_views.addstudentmodal');
 		}
 	}else{
 		return Redirect::back();
 	}
 
 });

Route::get('home/accountinfo/manageunassignedstudents', function() {
 	if(Auth::user()->isAdmin()){
 		$userInfo = User::whereNull('project_team_id')->where('id','<>',Auth::user()->id)->orderBy('lastname')->get();
 		if(Session::has('message')){
 			return View::make('team_managment.manageunassignedusers')
 			->with('userInfo', $userInfo)
 			->with('message',Session::get('message'));
 		} elseif(Session::has('error')){
 			return View::make('team_managment.manageunassignedusers')
 			->with('userInfo', $userInfo)
 			->with('error',Session::get('error'));
 		} else {
 			return View::make('team_managment.manageunassignedusers')
 			->with('userInfo', $userInfo);
 		}
 	}else{
 		return Redirect::back();
 	}
 
 });

Route::get('home/accountinfo/manageprojects', function() {
 	if(Auth::user()->isAdmin()){
 		$projectInfo = Project::orderBy('title')->get();
 		if(Session::has('message')){
 			return View::make('team_managment.manageprojects')
 			->with('projectInfo', $projectInfo)
 			->with('message', Session::get('message'))
 			->nest('addproject','modal_views.newprojmodal');
 		} elseif(Session::has('error')){
 			return View::make('team_managment.manageprojects')
 			->with('projectInfo', $projectInfo)
 			->with('error', Session::get('error'))
 			->nest('addproject','modal_views.newprojmodal');
 		} else {
 			return View::make('team_managment.manageprojects')
 			->with('projectInfo', $projectInfo)
 			->nest('addproject','modal_views.newprojmodal');
 		}
 	} else {
 		Redirect::back();
 	}
 
 });


//Route::put('home/generateteams','GenerateTeams@generateTeams'); //This will call the controller method generateTemas in GenerateTeams controller
Route::post('home/generateteams','GenerateTeams@generateTeams'); //This will call the controller method generateTemas in GenerateTeams controller


Route::put('home/accountinfo/passchange',function(){
		$userid = Input::get('userid');
		$user = User::where('id', intval($userid))->first();
		//dd(intval($userid));
		//dd($user);
		//TODO: Check the old password against the stored password using hash check
		// Verify that the new password and the confirmation of the new password match
		// if the correct old password is passed in is correct then change the password
		//  remember to hash the new password

		$old_pass = Input::get('password');
		$new_pass = Input::get('newpassword');
		$confirm_pass = Input::get('confirmpassword');

		if(Hash::check($old_pass, $user->password)) {
			if($new_pass != $confirm_pass) {
				return Redirect::to('home/accountinfo')->with('error', "Couldn't change password, new and confirm are not the same.");
			}
			$user->password = Hash::make($new_pass);
			$user->save();
			return Redirect::to('home/accountinfo')->with('message', 'Success');
		} else {
			return Redirect::to('home/accountinfo')->with('error', "Incorrect password");
		}
		// check that the old password is corrrect using Hash::check($old_pass,$user->password)
		// if thats the case then check if the new_pass and confirm_pass are the same
		// if the new and confirm password are correct hash the new password and save it to the user 

		//return Redirect::to('home/accountinfo')->with('message','Success');
}); //This will call the controller method changePassword in GenerateTeams controller

Route::put('home/accountinfo/namechange',function(){
	$userid = Input::get('userid');
	$user = User::where('id', $userid)->first();


	$firstname = Input::get('firstname');
	$lastname = Input::get('lastname');
	$user->firstname = $firstname;
	$user->lastname = $lastname;
	$user->save();
	//change the users first and last name
	return Redirect::to('home/accountinfo')->with('message','Success');
}); //This will call the controller method changeName in GenerateTeams controller

Route::put('home/accountinfo/degchange',function(){
	$userid = Input::get('userid');
	$user = User::where('id', $userid)->first();

	$majortext = Input::get('majortext');
	$minortext = Input::get('minortext');

	$user->majortext = $majortext;
	$user->minortext = $minortext;

	$user->save();

	//Change the users major and minor
	return Redirect::to('home/accountinfo')->with('message','Success');
}); //This will call the controller method changeMajor in GenerateTeams controller

Route::put('home/accountinfo/expchange',function(){
	$userid = Input::get('userid');
	$user = User::where('id', $userid)->first();


	$experience = Input::get('expirencetext');
	//Change the user experience text field

	$user->experience = $experience;
	$user->save();

	return Redirect::to('home/accountinfo')->with('message','Success');
}); //This will call the controller method changeExp in GenerateTeams controller

Route::put('home/accountinfo/projprefchange',function(){
	$userid = Input::get('userid');
	$user = User::where('id', intval($userid))->first();

	$first_project_id = Input::get('first_project_id');
	$second_project_id = Input::get('second_project_id');
	$third_project_id = Input::get('first_project_id');
	//get the project preferences object.
	$project_preferences = ProjectPreferences::where('user_id', intval($userid))->first();
	$project_preferences->first_project_id = $first_project_id;
	$project_preferences->second_project_id = $second_project_id;
	$project_preferences->third_project_id = $third_project_id;
	$project_preferences->save();
	//Change the users first second and third project preferences

	return Redirect::to('home/accountinfo')->with('message','Success');
}); //This will call the controller method changeProjPref in GenerateTeams controller

Route::put('home/accountinfo/partprefchange',function(){
		$userid = Input::get('userid');
		$user = User::where('id', intval($userid))->first();

		$pref_partners = Input::get('pref_partner');
		$nopref_partners = Input::get('no_pref_partner');
		$is_valid = true;
		foreach ($pref_partners as $pref_check) {
			if(in_array($pref_check, $nopref_partners)){
				$is_valid = false;
				break;
			}
		}

		if($is_valid){
		$pref_p_new = array();
		$pref_p_delete = array();
		$nopref_p_new = array();
		$nopref_p_delete = array();
		$pref_now_avoid = array();
		$avoid_now_pref = array();

		foreach($pref_partners as $pref_id){
			$prefs = PartnerPreferences::where('user_id',$user->id)->where('partner_id',$pref_id)->first();
			if(is_null($prefs)){
				$pref_p_new[] = $pref_id;
			} elseif ($prefs->avoid == 1) {
				$avoid_now_pref[] = $prefs->id;
			}
		}

		foreach($nopref_partners as $nopref_id){
			$noprefs = PartnerPreferences::where('user_id',$user->id)->where('partner_id',$nopref_id)->first();
			if(is_null($noprefs)){
				$nopref_p_new[] = $nopref_id;
			} elseif ($noprefs->avoid == 0) {
				$pref_now_avoid[] = $noprefs->id;
			}
		}		

		$prefered = PartnerPreferences::where('user_id',$user->id)->where('avoid','0')->get();
		$pref_p_delete = $prefered->filter(function($pref){
			$pref_partners = Input::get('pref_partner');
		$nopref_partners = Input::get('no_pref_partner');
			return (!in_array($pref->partner_id, $pref_partners) && !in_array($pref->partner_id, $nopref_partners));
		});

		$noprefered = PartnerPreferences::where('user_id',$user->id)->where('avoid','1')->get();
		$nopref_p_delete = $noprefered->filter(function($pref){
			$pref_partners = Input::get('pref_partner');
		$nopref_partners = Input::get('no_pref_partner');
			return (!in_array($pref->partner_id, $pref_partners) && !in_array($pref->partner_id, $nopref_partners));
		});

		foreach($pref_p_new as $new_pref){
			$partpref = new PartnerPreferences;
			$partpref->user_id = $user->id;
			$partpref->partner_id = $new_pref;
			$partpref->avoid = false;
			$partpref->save();
		}

		foreach($nopref_p_new as $new_nopref){
			$nopartpref = new PartnerPreferences;
			$nopartpref->user_id = $user->id;
			$nopartpref->partner_id = $new_nopref;
			$nopartpref->avoid = true;
			$nopartpref->save();
		}

		foreach ($pref_now_avoid as $nopref_id) {
			$now_avoid = PartnerPreferences::where('id',$nopref_id)->first();
			$now_avoid->avoid = true;
			$now_avoid->save();
		}

		foreach ($avoid_now_pref as $pref_id) {
			$now_pref = PartnerPreferences::where('id',$pref_id)->first();
			$now_pref->avoid = false;
			$now_pref->save();
		}

		foreach ($pref_p_delete as $todelete) {
			$todelete->delete();
		}

		foreach ($nopref_p_delete as $todelete) {
			$todelete->delete();
		}

		//Save the new project preferences and delete the old if they removed any

		$user->pref_part_or_proj = Input::get('pref_part_or_proj');
		$user->save();

		return Redirect::to('home/accountinfo')->with('message','Success');
	} else {
		return Redirect::to('home/accountinfo')->with('error','You cant avoid and perfer a person');
	}
}); //This will call the controller method changePartPref in GenerateTeams controller

Route::put('home/accountinfo/adminaddteam',function(){
	$projid = Input::get('projid');

	$userid = Input::get('user_id');

	$user = User::where('id',$userid)->first();
	//add the new user to the projid in the projectteams
	$projteam = new ProjectTeam;
	$projteam->user_id = $userid;
	$projteam->project_id = $projid;
	$projteam->save();
	$user->projectTeam()->associate($projteam);
	$user->save();

	return Redirect::to('home/editteam/'.$projid)->with('message','The new team member has been added');
}); //This will call the controller method adminAddMember in GenerateTeams controller

Route::put('home/accountinfo/managestudents/resetpass',function(){
	if(Auth::user()->isAdmin()){
		$userid = Input::get('userid');
		$user = User::where('id', intval($userid))->first();
				//reset the the password to the hash of the users cwid
		$user->password = Hash::make($user->cwid);
		$user->save();
		return Redirect::back()->with('message','Password reset');
	} else {
		return Redirect::back()->with('error','Your not authorized');
	}
}); //This will call the controller method resetPassword in GenerateTeams controller

Route::post('home/accountinfo/managestudents/newstudent', function(){
	if(Auth::user()->isAdmin()){
		$firstname = Input::get('firstname');
		$lastname = Input::get('lastname');
		$username = Input::get('username');
		$cwid = Input::get('cwid');

		$user = new User();

		$user->firstname = $firstname;
		$user->lastname = $lastname;
		$user->username = $username;
		$user->cwid = $cwid;
		$user->password = Hash::make($cwid);

		if($user->save()){
			return Redirect::back()->with('message', 'New student saved');
		} else {
			return Redirect::back()->with('message', 'Failed to save new student');
		}
	} else {
		return Redirect::back();
	}
}); //This will call the controller method newStudent in GenerateTeams controller

Route::delete('home/accountinfo/managestudents/deleteuser',function(){
	if(Auth::user()->isAdmin()) {
		$userid = intval(Input::get('userid'));
		$user = User::where('id', ($userid))->first();
		$user->delete();

		//now remove projectteams references
		ProjectTeam::where("user_id", $userid)->delete();

		//and also the partner preferences
		PartnerPreferences::where('user_id', $userid)->delete();
		PartnerPreferences::where('partner_id', $userid)->delete();
		//if Auth::user() is the admin then delete &user from the database tables
		//ProjectTeams ParnterPreferences ProjectPreferences Users etc..
		return Redirect::back()->with('message','User deleted');
	} else {
		return Redirect::back()->with('error', 'Not admin');
	}
}); //This will call the controller method deleteUser in GenerateTeams controller

Route::post('home/accountinfo/manageprojects/newproject', function(){
	if(Auth::user()->isAdmin()) {
			$title = Input::get('title');
			$company = Input::get('company');
			$min = Input::get('min');
			$max = Input::get('max');

			$project = new Project();

			$project->title = $title;
			$project->company = $company;
			$project->min = $min;
			$project->max = $max;
			
			if($project->save()){
				return Redirect::back()->with('message','The new project was added');
			} else {
				return Redirect::back()->with('message','Failed to save project');
			}
		} else {
			return Redirect::back()->with('error', 'Not admin');
		}
}); //This will call the controller method addProject in GenerateTeams controller

Route::delete('home/accountinfo/manageprojects/deleteproj', function(){
	if(Auth::user()->isAdmin()) {
			$projid = Input::get('projid');
			//delete the project from the database

			Project::find(intval($projid))->delete();
			//User::where('project_preferences_id', )


			//when we delete teh project team, we don't null the user project_team_id.
			//so, we loop through the users.
			$team_ids = ProjectTeam::where('project_id', intval($projid))->lists('id');
			foreach($team_ids as $team_id) {
				User::where('project_team_id', $team_id)->update(['project_team_id' => NULL]);
			}

			ProjectTeam::where('project_id', intval($projid))->delete();

			ProjectPreferences::where('first_project_id', intval($projid))->update(array('first_project_id' => NULL));
			ProjectPreferences::where('second_project_id', intval($projid))->update(array('second_project_id' => NULL));
			ProjectPreferences::where('third_project_id', intval($projid))->update(array('third_project_id' => NULL));


			return Redirect::back()->with('message','The project was deleted');
		} else {
			return Redirect::back()->with('error', 'Not admin');
		}
}); //This will call the controller method deleteProject in GenerateTeams controller


Route::delete('home/editteam/{projid}', function($projid){
	if(Auth::user()->isAdmin()){
		$userid = Input::get('userid'); //retrives the user id to dis associate with projid
		//get the user id, and the project id, and find the project team.
		$team_ids = ProjectTeam::where('user_id', intval($userid))->where('project_id', $projid)->lists('id');
		foreach($team_ids as $team_id) {
			User::where("project_team_id", $team_id)->update(['project_team_id' => NULL]);
		}

		ProjectTeam::where('user_id', intval($userid))->where('project_id', $projid)->delete();
		return Redirect::to('home/editteam/'.$projid)->with('message','User has now be removed from the team! '); 
	} else {
		return Redirect::back()->with('error', 'Not admin');
	}
});


View::composer('team_managment.firsttimelogin', function($view){

	//$projectoptions = 
	$projects = Project::all();
	$project_options = array_combine($projects->lists('id'), $projects->lists('title'));
	//$projectoptions = array_combine([1,2], ['test1','test2']);//formate (project_id list,title list)
	$users = User::where('id', '<>', Auth::user()->id)->where('is_admin', '<>', 1)->get();
	$firstnames = $users->lists('firstname');
	$lastnames = $users->lists('lastname');
	$arr = array_map(function($str1, $str2){ return $str1." ".$str2;}, $firstnames, $lastnames);
	$partner_options = array_combine($users->lists('id'), $arr);

	$view->with('partneroptions',$partner_options)->with('projoptions',$project_options);
});
});