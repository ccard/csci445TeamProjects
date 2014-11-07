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
	else {
		if(count(Auth::user()->projectPreferences())){
			return View::make('userhome');
		} else {
			return Redirect::to('firstlogin')->with('method','post');
		}
	}
});

Route::get('firstlogin', function(){
	return View::make('team_managment.firsttimelogin');
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

Route::post('firstlogin',function(){
	//perform inserts into appropriate tables etc
	return Redirect::to('home')->with('message','Your info has been saved');
})