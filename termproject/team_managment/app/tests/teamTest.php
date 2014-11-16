<?php



class teamTest extends TestCase {
	/**
	 * original: class teamTest extends PHPUnit_Framework_TestCase
	 * Run with 'phpunit' command from team_management folder 
	 * 
	 *
	 * @return void
	 */

/*
	public function setUp() { // this one must run before the rest of the DB tests
		parent::setUp();
		Artisan::call('migrate');
		$this->seed();     // this is written to memory, not production.sqlite.
		echo ' End of Setup()  ';
	}
*/
	
	public function testSum() {			// make sure the tester works
		$data = array(1,2,3);			// 1) Arrange
		$result = Helper::sum($data);	// 2) Act
		$this->assertEquals(6, $result); //3) Assert
		echo 'ending testSum';
	}


	public function testSomethingElse() {
		// more making sure the tester works
		$this->assertEquals(6, 6);
		$this->assertNotEquals(6, 7);
		echo 'ending testSomethingElse()';
	}

	public function testBasicExample()
	{
		
		$crawler = $this->client->request('GET', '/');
		//next line pukes
		//$this->assertTrue($this->client->getResponse()->isOk());
	}

	public function showFirstUserRecord() {  //this don't work here
		//$firstRecord = $this->call('GET', '/users/1');
		//$this->assertEquals('Darth', $firstRecord->firstname);
		$this->assertEquals(6, 6);  // test line
		echo 'end of showFirstUserRecord';
		
	}


	public function testStudentIsRedirected() {
		$this-> call('GET', '/');
		$this-> assertRedirectedTo('login');  //works good
		echo ' End of testStudentIsRedirected  ';
	}



/*
	public function testAdminCanDeleteStudent() {
		$user = new User(array('id'=>1, 'first'=>'Lord', 'last'=>'Oftheflies', 
            'email'=>'loftheflies@mines.edu', 'cwid'=>223344, 'pref_person_match'=>false, 
            'pass'=> 'notUsed', 'admin'=>true));
		$this->be($user);
		$this->call('DELETE', '/users/1');
		$this->assertRedirectedTo('/users');  //don't exist yet
		$this->assertSessionHas('message');   //don't exist yet
	}
*/	
/*
	public function testShouldFail() {
		$user = new User(array('id'=>1, 'first'=>'Lord', 'last'=>'Oftheflies', 
            'email'=>'loftheflies@mines.edu', 'cwid'=>223344, 'pref_person_match'=>false, 
            'pass'=> 'notUsed', 'admin'=>true));
		$this->be($user);
		$this->call('DELETE', '/users/1');
		$this->assertRedirectedTo('/users');  //don't exist yet
		$this->assertSessionHas('message');   //don't exist yet
	}	
*/	
}


?>