<?php
namespace Beldougie\CommonBundle\Tests\BaseClasses;

use Doctrine\DBAL\Schema\SchemaException;

use Doctrine\ORM\Tools\SchemaTool;

use PHPUnit_Framework_TestCase;

require_once dirname(__DIR__)."/../../../../app/AppKernel.php";

/**
 * @author Matt Keeble
 *
 */
abstract class BaseDatabaseTestCase extends \PHPUnit_Framework_TestCase {

	/**
	 * 
	 * @var Symfony\Component\HttpKernel\AppKernel
	 */
	protected $kernel;
	
	/**
	 * 
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $entityManager;
	
	/**
	 * 
	 * @var Symfony\Component\DependencyInjection\Container
	 */
	protected $container;
	
	/**
	 * Ensure you override this method in a child-class and then call this 
	 * method FIRST using parent::setUp() to initiate the database schema. 
	 * 
	 * Add an entity to setup:
	 * 	$this->entityManager->persist($this->entity);
	 * 
	 * And then commit to the database
	 * 	$this->entityManager->flush();
	 * 
	 * Tip: create a method that sets your object to a local property and 
	 * returns it for use in the persist method ;)
	 * 
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp() 
	{
		// Boot the AppKernel in the test environment with debug
		$this->kernel = new \AppKernel("test", true);
		$this->kernel->boot();
		
		// Store the container and the entity manager in test case properties
		$this->container = $this->kernel->getContainer();
		$this->entityManager = $this->container->get('doctrine')->getEntityManager();
		
		// Build the schema for the database
		$this->generateSchema();
		
		parent::setUp();
	}
	
	public function tearDown() 
	{
		// drop the database
		// put a check on this to see if schema is created in memory or not
		$this->dropSchema();
		
		// shutdow the kernel
		$this->kernel->shutdown();
		parent::tearDown();
	}
	
	protected function generateSchema()
	{
		$this->getSchemaTool()->createSchema($this->getMetadata());
	}
	
	protected function dropSchema()
	{
		$this->getSchemaTool()->dropDatabase($this->getMetadata());
	}
	
	/**
	 * 
	 * @throws SchemaException
	 * @return \Doctrine\ORM\Tools\SchemaTool
	 */
	protected function getSchemaTool()
	{
		$metadata = $this->getMetadata();
		if(!empty($metadata)) {
			// create a schema tool
			return new SchemaTool($this->entityManager);
		} else {
			throw new SchemaException("No metadata found to process.");
		}
	}
	
	protected function getMetadata()
	{
		return $this->entityManager->getMetadataFactory()->getAllMetadata();
	}

}
