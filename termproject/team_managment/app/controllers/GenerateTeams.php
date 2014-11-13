<?php

class GenerateTeams extends BaseController {

	public function generateTeams()
	{
		//TODO Place table generation code calls here

	//Then redirect to home
	return Redirect::to('home');
	}

	public function changePassword(User $usr){

		return Redirect::to('home/accountinfo');
	}

	public function changeName(User $usr){
		return Redirect::to('home/accountinfo');
	}

	public function changeMajor(User $usr){
		return Redirect::to('home/accountinfo');
	}

	public function changeExp(User $usr){
		return Redirect::to('home/accountinfo');
	}

	public function changeProjPref(User $usr){
		return Redirect::to('home/accountinfo');
	}

	public function changePartPref(User $usr){
		return Redirect::to('home/accountinfo');
	}
}