<?php
/**
 * Represents a state.
 *
 * @package State
 * @subpackage State
 */

namespace State;

/**
 * The class which represents a state.
 */
abstract class StateAbstract implements StateInterface
{
	/**
	 * The unique identifier of the state.
	 *
	 * @var string
	 */
	private $identifier;

	/**
	 * The URL to the previous state.
	 *
	 * @var string $previousUrl
	 */
	private $previousUrl = '';

	/**
	 * Initialize a new StateAbstract.
	 */
	final public function __construct()
	{
		$this->setIdentifier(static::identifier());
	}

	/**
	 * Get the unique identifier of the state.
	 *
	 * @return string
	 */
	final public function getIdentifier()
	{
		return $this->identifier;
	}

	/**
	 * Create the URL to the concrete state.
	 *
	 * @return string
	 */
	final public static function createUrl()
	{
		$identifier = static::identifier();

		return "/{$identifier}/";
	}

	/**
	 * Set the unique identifier of the state.
	 *
	 * @param string $identifier
	 * @return void
	 * @throws \InvalidArgumentException When $identifier is not a string or empty.
	 */
	private function setIdentifier($identifier)
	{
		if (is_string($identifier) === false
			|| empty($identifier) === true
		) {
			throw new \InvalidArgumentException(
				'Invalid identifier supplied: ' . var_export($identifier, true)
			);
		}

		$this->identifier = $identifier;
	}

	/**
	 * Get the URL to the previous state.
	 *
	 * @return string
	 */
	public function getPreviousUrl()
	{
		return $this->previousUrl;
	}

	/**
	 * Set the URL to the previous state.
	 *
	 * @param string $previousUrl
	 * @throws \InvalidArgumentException When $previousUrl is not of type string.
	 */
	public function setPreviousUrl($previousUrl)
	{
		if (is_string($previousUrl) === false) {
			throw new \InvalidArgumentException(
				'Expected previousUrl to be an instance of string, got: '
				. var_export($previousUrl)
			);
		}

		$this->previousUrl = $previousUrl;
	}
}