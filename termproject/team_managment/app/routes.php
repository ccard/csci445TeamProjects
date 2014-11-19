<?php

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
		//TODO query database to retrive these items
		$users = count(array()); //the number of users in the system
		$emails = 'test@aol.com,test2@aol.com';//populate with list of emails
		$projects = count(array()); //the number of projects in the system
		$projectteams = array(); //Project teams is in the following format array('projectid'=>array('projname'=>'projname', 'members'=>array('email'=>'name')))
		return View::make('team_managment.adminhome')->with('users',$users)->with('projects',$projects)->with('projectteams', $projectteams)->with('emails',$emails);
	} else {
		//dd(Auth::user()->project_preferences_id);
		//If the user has no project preferences then they must be redirected to the firstogin page
		if(!empty(Auth::user()->project_preferences_id)){
			$project = array(); //TODO: replace this with a query to database to get project name and all associted student names and emails
			//in the form of array('projname'=>"name", 'members'=>array('email'=>"name"))
			return View::make('team_managment.userhome')->with('user',Auth::user())->with('project',$project);
		} else {
			return Redirect::to('home/firstlogin');
		}
	}
});

Route::get('home/firstlogin', function(){
	//Pass in user information to the form must be TODO make sure this works
	if(Session::has('error')) {
		return View::make('team_managment.firsttimelogin')->with('user',Auth::user())->with('method','post')->with('error', Session::get('error'));
	} else {
		return View::make('team_managment.firsttimelogin')->with('user',Auth::user())->with('method','post');
	}	
});

Route::get('home/accountinfo', function(){
	 if (Auth::user()->isAdmin()) {
		$user = Auth::user();
	 	return View::make('team_managment.adminaccount')->with('user',$user)
	 	->nest('passchange','modal_views.passmodal',array('user'=>$user))
		->nest('namechange','modal_views.namechangmodal',array('user'=>$user));
	} else {
		//TODO pass all relevent information to the user and admin account pages
		$user = Auth::user();
		$projectoptions = array_combine([1,2],['test1','test2']);//TODO replace with db query
		$partneroptions = array_combine([1,2],['test1','test2']);//TODO replace with db query
		$perferedchoice = array(1); //TODO replace with query from db
		$avoidchoice = array(2); //TODO replace with query from db
		if(Session::has('message')){
			return View::make('team_managment.useraccount')->with('user',$user)
				->with('partneroptions',$partneroptions)
				->with('perferedchoice',$perferedchoice)
				->with('avoidchoice',$avoidchoice)
				->with('message',Session::get('message'))
				->nest('passchange','modal_views.passmodal',array('user'=>$user))
				->nest('namechange','modal_views.namechangmodal',array('user'=>$user))
				->nest('degchange','modal_views.degchangemodal',array('user'=>$user))
				->nest('expchange','modal_views.expchangemodal',array('user'=>$user))
				->nest('projprefchange','modal_views.projprefchangemodal',array('user'=>$user,'projoptions'=>$projectoptions))
				->nest('partprefchange','modal_views.partprefchangemodal',array('user'=>$user,'partneroptions'=>$partneroptions, 'perferedchoice'=>$perferedchoice, 'avoidchoice'=>$avoidchoice));
		} else {
			return View::make('team_managment.useraccount')->with('user',$user)
				->with('partneroptions',$partneroptions)
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
		$projectteam = array('projid'=>'1','projname'=>'test', 'users'=>array('12'=>array('name'=>'chris','email'=>'test@aol.com'))); //of the form ('projid'=>id, 'projname'=>'projname', 'users'=>array('userid'=>array('name'=>'name', 'email'=>'email')...))
		$nonassignusers = array_combine([1],['user']); //combined list of users where the first part is the user id and the second part is the user name
		if(Session::has('message')){
			return View::make('team_managment.editteam')->with('projectteam',$projectteam)->with('message',Session::get('message'))
			->nest('adminaddteam','modal_views.adminaddteammodal',array('projid'=>$projid,'nonassignusers'=>$nonassignusers));
		} else {
			return View::make('team_managment.editteam')->with('projectteam',$projectteam)
			->nest('adminaddteam','modal_views.adminaddteammodal',array('projid'=>$projid,'nonassignusers'=>$nonassignusers));
		}
	} else {
		return Redirect::back();
	}
});	

Route::get('users/{id}/info', function($id){
	if(Auth::user()->isAdmin()){
		$method = 'get'; // to just view the information
		$user = Auth::user();//replace with a query for the user id
		$projectoptions = array_combine([1,2],['test1','test2']);//TODO replace with db query
		$partneroptions = array_combine([1,2],['test1','test2']);//TODO replace with db query
		$perferedchoice = array(1); //TODO replace with query from db
		$avoidchoice = array(2); //TODO replace with query from db
		return View::make('team_managment.useraccount')->with('method',$method)
		->with('user',$user)
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
	//TODO perform inserts into appropriate tables etc and perform input sanitation and validation

	// query = update users set (majortext, minortext, experienceid, projprefid, pref_partor_proj, )
	$user = Auth::user();
	//$user->firstname = Input::
	$project_preferences = new ProjectPreferences;
	$project_preferences->user_id = $user->id;
	$project_preferences->first_project_id = Input::get("first_project_id");
	$project_preferences->second_project_id = Input::get("second_project_id");
	$project_preferences->third_project_id = Input::get("third_project_id");
	//$project_preferences->save();
	$user->projectPreferences()->save($project_preferences);
	
	$experiences = new Experiences;

	//dd(Input::get('expirencetext'));


	//dd($user->experiences()->save($experiences));

	$user->majortext = Input::get('majortext');
	$user->minortext = Input::get('minortext');
	$user->experience = Input::get('expirencetext');
	$user->pref_part_or_proj = Input::get('pref_part_or_proj');
	$pref_partners = Input::get('pref_partner');
	$pref_partners_array = array();
	foreach($pref_partners as $pref_partner) {
		$partner_preferences = new PartnerPreferences;
		$partner_preferences->user_id = $user->id;
		$partner_preferences->partner_id = $pref_partner;
		$partner_preferences->avoid = false;
		$partner_preferences->save();
		//$user->partnerPreferences()->attach($partner_preferences);
		//array_push($pref_partners_array, $partner_preferences);
		//$user->partnerPreferences()->attach($partner_preferences, ["user_id"=>$user->id]);

	}
	//dd($user->partnerPreferences());
	// $user->partnerPreferences()->sync($pref_partners_array);
	//$user

	$nopref_partners = Input::get('no_pref_partner');
	$nopref_partners_array = array();
	foreach($nopref_partners as $nopref_partner) {
		$nopartner_preferences = new PartnerPreferences;
		$nopartner_preferences->user_id = $user->id;
		$nopartner_preferences->partner_id = $nopref_partner;
		$nopartner_preferences->avoid = true;
		$nopartner_preferences->save();
		//array_push($nopref_partners_array, $nopartner_preferences);
	}
	//$user->partnerPreferences()->saveMany($nopref_partners_array);

	//$partner_prefernces->partner_id
	if($user->save()) { 
		return Redirect::to('home')->with('message', 'Your info has been saved.');
	} else {
		return Redirect::to('home/firstlogin')->with('error', 'Your info has not been saved.');
	}
	//$user->experiencetext = Input::get('experiencetext');

	/*$project_prefrences = ProjectPreferences::create(Input::all());
	$project_preferences->user_id = Auth::user()->id;
	
	if($project_preferences->save()) {
		return Redirect::to('home')->with('message','Your info has been saved');
	} else {
		return Redirect::back()->with('error', 'Could not save info');
	}*/
	//return Redirect::to('home');
});

Route::put('home/generateteams','GenerateTeams@generateTeams'); //This will call the controller method generateTemas in GenerateTeams controller

Route::put('home/accountinfo/passchange','GenerateTeams@changePassword'); //This will call the controller method changePassword in GenerateTeams controller

Route::put('home/accountinfo/namechange','GenerateTeams@changeName'); //This will call the controller method changeName in GenerateTeams controller

Route::put('home/accountinfo/degchange','GenerateTeams@changeMajor'); //This will call the controller method changeMajor in GenerateTeams controller

Route::put('home/accountinfo/expchange','GenerateTeams@changeExp'); //This will call the controller method changeExp in GenerateTeams controller

Route::put('home/accountinfo/projprefchange','GenerateTeams@changeProjPref'); //This will call the controller method changeProjPref in GenerateTeams controller

Route::put('home/accountinfo/partprefchange','GenerateTeams@changePartPref'); //This will call the controller method changePartPref in GenerateTeams controller

Route::put('home/accountinfo/adminaddteam','GenerateTeams@adminAddMember'); //This will call the controller method adminAddMember in GenerateTeams controller

Route::delete('home/editteam/{projid}', function($projid){
	if(Auth::user()->isAdmin()){
		$userid = Input::get('userid'); //retrives the user id to dis associate with projid
		//TODO remove the users association with the project
		return Redirect::to('home/editteam/'.$projid)->with('message','Remove has no be removed from team! '.$userid);
	} else {
		return Redirect::back();
	}
});

//TODO: Replace this with the appropriate queries to get projects
View::composer('team_managment.firsttimelogin', function($view){
	//TODO: Replace with appropriate quires to the databse
	//$projectoptions = 
	$projects = Project::all();
	$project_options = array_combine($projects->lists('id'), $projects->lists('title'));
	//$projectoptions = array_combine([1,2], ['test1','test2']);//formate (project_id list,title list)
	$users = User::where('id', '<>', Auth::user()->id)->where('is_admin', '<>', 1)->get();
	$firstnames = $users->lists('firstname');
	$lastnames = $users->lists('lastname');
	$arr = array_map(function($str1, $str2){ return $str1." ".$str2;}, $firstnames, $lastnames);
	$partner_options = array_combine($users->lists('id'), $arr);
	//$partneroptions = array_combine([1,2], ['test1','test2']);
	// if(count($genres) > 0){
	// 	$genre_options = array_combine($genres->lists('id'), $genres->lists('name'));
	// } else {
	// 	$genre_options = array_combine(null,'Unspecified');
	// }
	$view->with('partneroptions',$partner_options)->with('projoptions',$project_options);
});
});