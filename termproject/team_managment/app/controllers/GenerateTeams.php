<?php

class GenerateTeams extends BaseController {

	public function generateTeams()
	{
		//TODO Place table generation code calls here

	//Then redirect to home
	return Redirect::to('home')->with('message','Success');
	}

	public function changePassword(User $usr){

		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function resetPassword(){
		$userid = Input::get('userid');
		return Redirect::back()->with('message','password changed');
	}

	public function changeName(User $usr){
		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changeMajor(User $usr){
		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changeExp(User $usr){
		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changeProjPref(User $usr){
		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function changePartPref(User $usr){
		return Redirect::to('home/accountinfo')->with('message','Success');
	}

	public function adminAddMember(){
		$projid = Input::get('projid');
		return Redirect::to('home/editteam/'.$projid)->with('message','Success '.$projid);
	}
}