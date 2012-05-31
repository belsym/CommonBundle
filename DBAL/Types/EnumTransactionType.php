<?php
namespace Beldougie\CommonBundle\DBAL\Types;
use Beldougie\CommonBundle\DBAL\Types\EnumType;

/**
 * @author Matt Keeble
 *
 */
class EnumTransactionType extends EnumType {

	protected $name = "enumtransactiontype";
	protected $values = array('expense', 'income');
}
