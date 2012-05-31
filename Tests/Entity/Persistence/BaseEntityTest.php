<?php
namespace Beldougie\CommonBundle\Tests\Persistence;

use Beldougie\CommonBundle\Tests\BaseClasses\BaseFixtureLoadingTestCase;

use Beldougie\CommonBundle\Entity\Test\TestUser;
use Beldougie\CommonBundle\Tests\BaseClasses\BaseDatabaseTestCase;


/**
 * @author Matt Keeble
 *
 */
class BaseEntityTest extends BaseFixtureLoadingTestCase  
{
	const DEFAULT_BASEUSER_FIRSTNAME = 'Joe';
	const DEFAULT_BASEUSER_LASTNAME = 'Bloggs';
	const DEFAULT_BASEUSER_DOB_STR = '1970-09-04 00:00:00';
	
	private $dob;
	private $user;
	
	public function setUp() {
	
		parent::setUp();
	
		$this->loadEntities();
	}
	
	public function testBaseEntity_Persistence_PKIsSet()
	{
		$this->assertNotEmpty($this->user->getId(), "BaseEntity Id after persistence");
	}
	
	public function testBaseEntity_Persistence_TimestampableOnCreateSet()
	{
		$this->assertNotEmpty($this->user->getCreatedAt(), "BaseEntity CreatedAt after persistence");
	}
			
	public function testBaseEntity_Persistence_TimestampableOnModifiedSet()
	{
		$this->assertNotEmpty($this->user->getModifiedAt(), "BaseEntity ModifiedAt after persistence");
	}

	public function loadEntities()
	{
		$this->user = $this->entityManager->find('Beldougie\CommonBundle\Entity\Test\TestUser',1);
	}
	
	/**
	 * @see BaseFixtureLoadingTestCase
	 */
	public function getFixtures() {
		return array(
			dirname(dirname(dirname(__DIR__))).'/DataFixtures/Test'	
		);
	}

}
