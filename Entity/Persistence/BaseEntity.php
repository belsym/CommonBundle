<?php
namespace Beldougie\CommonBundle\Entity\Persistence;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @author Matt Keeble
 *
 * @ORM\MappedSuperclass
 */
abstract class BaseEntity {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	 * @var integer
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="created_at", type="datetime", nullable=false)
	 * @Gedmo\Timestampable(on="create")
	 * @var \DateTime
	 */
	private $created_at;
	
	/**
	 * @ORM\Column(name="modified_at", type="datetime", nullable=true)
	 * @Gedmo\Timestampable(on="update")
	 * @var \DateTime
	 */
	private $modified_at;


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
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set modified_at
     *
     * @param datetime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modified_at = $modifiedAt;
    }

    /**
     * Get modified_at
     *
     * @return datetime 
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }
    
    /**
     * Factory method: create an object using the key=>value pairs in $array 
     * where `key` equals a property name in the object
     * 
     * @param array $array
     */
    public static function fromArray($array) {
    	
    	$clazz = get_called_class();
    	
    	$obj = new $clazz();
    	
    	foreach($array as $property => $value) {
    		if(property_exists($obj, $property)) {
    			$obj->$property = $value;
    		}
    	}
    	
    	return $obj;
    }
}