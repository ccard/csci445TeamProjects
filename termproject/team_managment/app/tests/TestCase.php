<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	public function setUp() { // this one must run before the rest of the DB tests
			// it loads the database into memory, but not the hard disk.
		parent::setUp();
		$this->prepareForTests();

	}	

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	public function prepareForTests() //http://culttt.com/2013/05/20/getting-started-with-testing-laravel-4-models/
	{
  		Artisan::call('migrate');
		Mail::pretend(true);
		$this->seed();     // this is written to memory, not production.sqlite.
		//echo ' End of Setup()  ';
	}	

}
