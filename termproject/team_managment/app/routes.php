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

Route::get('home', function() {
	if (Auth::user()->isAdmin()){
		return View::make('team_managment.adminhome');
	} else {
		if(count(Auth::user()->projectPreferences())){
			return View::make('team_managment.userhome');
		} else {
			return Redirect::to('home/firstlogin');//->with('method','put');
		}
	}
});

Route::get('home/firstlogin', function(){
	//Pass in user information
	return View::make('team_managment.firsttimelogin')->with('user',Auth::user())->with('method','post');
});

/*------------------------------------------------------------------------
 Post routes
 */

Route::post('login',function(){
	if(Auth::attempt(Input::only('username','password'))){
		return Redirect::intended('/');
	} else {
		return Redirect::back()->withInput()->with('error',"Invalid credentials!");
	}
});

Route::put('home/firstlogin/{id}',function($id){
	//perform inserts into appropriate tables etc
	return Redirect::to('home')->with('message','Your info has been saved');
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