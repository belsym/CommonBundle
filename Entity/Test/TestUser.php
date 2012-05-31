<?php
namespace Beldougie\CommonBundle\Entity\Test;

use Beldougie\CommonBundle\Entity\Persistence\BaseEntity;
use Beldougie\CommonBundle\Entity\Persistence\BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * This Class is used for internal testing purposes only.
 * Remove this class and associated tests from deployed versions of this bundle
 * 
 * 
 * @copyright 2012 Beldougie Ltd
 * @author Matt Keeble <matt.keeble@gmail.com>
 * 
 * @ORM\Entity
 * @ORM\Table(name="bel_test_user")
 */
class TestUser extends BaseUser {
	
}
