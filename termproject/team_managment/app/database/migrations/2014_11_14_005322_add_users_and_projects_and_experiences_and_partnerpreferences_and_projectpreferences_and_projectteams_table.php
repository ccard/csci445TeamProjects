<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersAndProjectsAndExperiencesAndPartnerpreferencesAndProjectpreferencesAndProjectteamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('password');
			$table->string('username')->unique();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('majortext')->nullable();
			$table->string('minortext')->nullable();
			$table->integer('experience_id')->nullable();
			$table->integer('projectpreference_id')->nullable();
			$table->integer('pref_part_or_proj');
			$table->integer('project_id')->nullable();
		});

		Schema::create('projects', function($table){
			$table->increments('id');
			$table->string('title')->unique();
			$table->string('company');	
		});

		Schema::create('experiences', function($table){
			$table->increments('id');
			$table->string('experience');
		});

		Schema::create('parnterpreferences', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('partner_id');
			$table->integer('avoid');
		});

		Schema::create('projectpreferences', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('first_project_id');
			$table->integer('second_project_id');
			$table->integer('third_project_id');
		});

		Schema::create('projectteams', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('project_id');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');		
		Schema::drop('projects');
		Schema::drop('experiences');
		Schema::drop('parnterpreferences');
		Schema::drop('projectpreferences');
		Schema::drop('projectteams');		
	}

}