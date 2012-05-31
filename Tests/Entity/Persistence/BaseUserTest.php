<?php
namespace Beldougie\CommonBundle\Tests;
use Beldougie\CommonBundle\Tests\BaseClasses\BaseDatabaseTestCase\BaseDatabaseTestCase;

use Beldougie\CommonBundle\Entity\Test\TestUser;

/**
 * @author Matt Keeble
 *
 */
class BaseUserTest extends \PHPUnit_Framework_TestCase {
	
	const DEFAULT_BASEUSER_FIRSTNAME = 'Joe';
	const DEFAULT_BASEUSER_LASTNAME = 'Bloggs';
	const DEFAULT_BASEUSER_DOB_STR = '1970-09-04 00:00:00';
	
	private $dob;
	private $user;
	
	public function setUp() {

		parent::setUp();
		
		$this->createTestUser();
	}
	
	public function testBaseUser_GetAndSet_FirstName()
	{
		$this->assertEquals(self::DEFAULT_BASEUSER_FIRSTNAME, $this->user->getFirstName());
	}
	
	public function testBaseUser_GetAndSet_LastName()
	{
		$this->assertEquals(self::DEFAULT_BASEUSER_LASTNAME, $this->user->getLastName());
	}
	
	public function testBaseUser_GetAndSet_DateOfBirth()
	{
		$this->assertEquals($this->dob, $this->user->getDateOfBirth());
	}
	
	protected function createTestUser()
	{
		$this->user = new TestUser();
		$this->dob = new \DateTime(self::DEFAULT_BASEUSER_DOB_STR);
			
		$this->user->setFirstName(self::DEFAULT_BASEUSER_FIRSTNAME);
		$this->user->setLastName(self::DEFAULT_BASEUSER_LASTNAME);
		$this->user->setDateOfBirth($this->dob);
	}
	
}
