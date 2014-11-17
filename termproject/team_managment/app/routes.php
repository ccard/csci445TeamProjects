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

Route::post('login',function(){
	//dd(Input::only('username','password'));
	if(Auth::attempt(Input::only('username','password'))){
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
		//If the user has no project preferences then they must be redirected to the firstogin page
		if(count(Auth::user()->projectpreference)){
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
	return View::make('team_managment.firsttimelogin')->with('user',Auth::user())->with('method','put');
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


Route::put('home/firstlogin/{id}',function($id){
	//TODO perform inserts into appropriate tables etc and perform input sanitation and validation
	return Redirect::to('home')->with('message','Your info has been saved');
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
	$projectoptions = array_combine([1,2], ['test1','test2']);
	$partneroptions = array_combine([1,2], ['test1','test2']);
	// if(count($genres) > 0){
	// 	$genre_options = array_combine($genres->lists('id'), $genres->lists('name'));
	// } else {
	// 	$genre_options = array_combine(null,'Unspecified');
	// }
	$view->with('partneroptions',$partneroptions)->with('projoptions',$projectoptions);
});
});