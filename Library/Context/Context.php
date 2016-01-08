<?php
/**
 * Represents the context for the state machine.
 *
 * @package Context
 * @subpackage Context
 */

namespace Context;

/**
 * The class which represents the context for the state machine.
 */
class Context
{
	/**
	 * The first name of the customer.
	 *
	 * @var string
	 */
	private $firstName;

	/**
	 * The last name of the customer.
	 *
	 * @var string
	 */
	private $lastName;

	/**
	 * The chosen payment method.
	 *
	 * @var string
	 */
	private $paymentMethod;

	/**
	 * Whether the context is mutable.
	 *
	 * @var boolean
	 */
	private $mutable = true;

	/**
	 * Get the first name of the customer.
	 *
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * Set the first name of the customer.
	 *
	 * @param string $firstName
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = (string) $firstName;
	}

	/**
	 * Get the last name of the customer.
	 *
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * Set the last name of the customer.
	 *
	 * @param string $lastName
	 */
	public function setLastName($lastName)
	{
		$this->lastName = (string) $lastName;
	}

	/**
	 * Whether the context is mutable.
	 *
	 * @return boolean
	 */
	public function isMutable()
	{
		return $this->mutable;
	}

	/**
	 * Set whether the context is mutable.
	 *
	 * @param boolean $mutable
	 */
	public function setMutable($mutable)
	{
		$this->mutable = (bool) $mutable;
	}

	/**
	 * Get the chosen payment method.
	 *
	 * @return string
	 */
	public function getPaymentMethod()
	{
		return $this->paymentMethod;
	}

	/**
	 * Set the chosen payment method.
	 *
	 * @param string $paymentMethod
	 */
	public function setPaymentMethod($paymentMethod)
	{
		$this->paymentMethod = (string) $paymentMethod;
	}
}