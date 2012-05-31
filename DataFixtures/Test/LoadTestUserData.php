<?php
namespace Beldougie\CommonBundle\DataFixtures\Test;

use Beldougie\CommonBundle\Entity\Test\TestUser;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Matt Keeble
 *
 */
class LoadTestUserData implements FixtureInterface {

	/**
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager) {
		
		$manager->persist($this->createTestUser());		
		$manager->flush();
	}
	
	protected function createTestUser()
	{
		$u = new TestUser();
		$u->setFirstName('Joe');
		$u->setLastName('Bloggs');
		$u->setDateOfBirth(new \DateTime('4 September 1971'));
		
		return $u;
	}
}
