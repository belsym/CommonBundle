<?php
namespace Beldougie\CommonBundle\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * @author Matt Keeble
 *
 */
abstract class EnumType extends Type {

	protected $name;
	protected $values = array();

	/**
	 * @param array $fieldDeclaration
	 * @param AbstractPlatform $platform
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
		$values = array_map(function($val) { return "'".$val."'";}, $this->values);
		return "ENUM (".implode(", ", $values).") COMMENT '(DC2Type:".$this->name.")'";
	}
	
	
	/**
	 * @param string $value
	 * @param AbstractPlatform $platform
	 * @return mixed
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform) {
		return $value;
	}

	/**
	 * @param string $value
	 * @param AbstractPlatform $platform
	 * @return mixed
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform) {
		if(!in_array($value, $this->values)) {
			throw new \InvalidArgumentException("Invalid '".$this->name."' value");
		}
		
		return $value;
	}


	/**
	 * 
	 */
	public function getName() {
		return $this->name;

	}

}