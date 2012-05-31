<?php
namespace Beldougie\CommonBundle\Entity\Persistence;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Matt Keeble
 * @ORM\MappedSuperclass
 */
abstract class BaseUser extends BaseEntity {

	/**
	 * @ORM\Column(name="first_name", type="string", length=40, nullable=true)
	 * @var string
	 */
	private $first_name;
	
	/**
	 * @ORM\Column(name="last_name", type="string", length=40, nullable=true)
	 * @var string
	 */
	private $last_name;
	
	/**
	 * @ORM\Column(name="date_of_birth", type="datetime", nullable=true)
	 * @var \DateTime
	 */
	private $date_of_birth;
	
    /**
     * Set first_name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set date_of_birth
     *
     * @param datetime $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->date_of_birth = $dateOfBirth;
    }

    /**
     * Get date_of_birth
     *
     * @return datetime 
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }
}