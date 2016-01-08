<?php
/**
 * Represents the abstract of a response.
 *
 * @package Response
 * @subpackage ResponseAbstract
 */

namespace Response;

/**
 * The class which represents the abstract of a response.
 */
abstract class ResponseAbstract
{
	/**
	 * The status code to send with the request.
	 *
	 * @var int
	 */
	private $statusCode;

	/**
	 * Initialize a new ResponseAbstract.
	 *
	 * @param int $statusCode
	 */
	public function __construct($statusCode)
	{
		$this->setStatusCode($statusCode);
	}

	/**
	 * Get the status code to send with the request.
	 *
	 * @return int
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * Set the status code to send with the request.
	 *
	 * @param int $statusCode
	 * @return static
	 * @throws \InvalidArgumentException When $statusCode is invalid.
	 */
	private function setStatusCode($statusCode)
	{
		if (is_int($statusCode) === false) {
			throw new \InvalidArgumentException(
				'Expected statusCode to be of type integer, got: '
				. var_export($statusCode)
			);
		}

		$this->statusCode = $statusCode;

		return $this;
	}
}