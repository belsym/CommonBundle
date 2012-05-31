<?php
namespace Beldougie\CommonBundle\Entity\Persistence;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adds a basic enum type system using lookup tables. Extend this class 
 * directly and use annotations to map it as an Entity to use.
 * 
 * Can only use strings as values. If other values are needed, simply overload 
 * the $value type in the child class 
 * 
 * 
 * @author Matt Keeble
 * @ORM\MappedSuperclass
 */
abstract class BaseLookup {

	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 *
	 * @var integer
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="value", type="string", length=50, nullable=false, unique=true)
	 * @var string
	 */
	private $value;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}