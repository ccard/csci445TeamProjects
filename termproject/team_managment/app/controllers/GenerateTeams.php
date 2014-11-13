<?php

class GenerateTeams extends BaseController {

	public function generateTeams()
	{
		//TODO Place table generation code calls here

	//Then redirect to home
	return Redirect::to('home');
	}

	public function changePassword(User $usr){

		return Redirect::to('home/accountinfo')->with('user',$usr)->with('message',"Password changed");
	}

}