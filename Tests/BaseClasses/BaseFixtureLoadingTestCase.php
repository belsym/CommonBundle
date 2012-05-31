<?php
namespace Beldougie\CommonBundle\Tests\BaseClasses;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;

use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

use Doctrine\Common\DataFixtures\Loader;

use Doctrine\ORM\Tools\Setup;

use Beldougie\CommonBundle\Tests\BaseClasses\BaseDatabaseTestCase;

/**
 * @author Matt Keeble
 *
 */
abstract class BaseFixtureLoadingTestCase extends BaseDatabaseTestCase {

	/* (non-PHPdoc)
	 * @see Beldougie\CommonBundle\Tests\BaseClasses.BaseDatabaseTestCase::setUp()
	 */
	public function setUp() 
	{
		parent::setUp();
		
		$this->loadFixtures();
	}
	
	/**
	 * @throws InvalidTypeException
	 */
	protected function loadFixtures()
	{
		$loader = new Loader();
		$fixtureDirs = $this->getFixtures();
		$fixtures = array();
		
		if(!is_array($fixtureDirs)) 
		{
			throw new InvalidTypeException('Result from '.__CLASS__.'::getFixtures() must be an array');
		}
		
		foreach($fixtureDirs as $dir) 
		{
			$loader->loadFromDirectory($dir);	
		}
		
		foreach($loader->getFixtures() as $key=>$fixture) 
		{
			if($fixture instanceof ContainerAwareInterface) 
			{
				$fixture->setContainer($this->container);
			}
			$fixtures[$key] = $fixture;
		}
		
		
		$purger = new ORMPurger($this->entityManager);
		$executer = new ORMExecutor($this->entityManager, $purger);
		$executer->execute($fixtures);
	}
	
	/**
	 * Should be implemented to return an array of directory paths such as 
	 * 	array('Beldougie/MyBundle/DataFixtures/Test')
	 * 
	 * @return	array	an array of directory paths that contain fixtures to load
	 */
	abstract public function getFixtures();
}
