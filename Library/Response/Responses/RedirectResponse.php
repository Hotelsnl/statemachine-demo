<?php
/**
 * Represents a redirect response which points the client to a new location.
 *
 * @package Response
 * @subpackage Responses
 */

namespace Response\Responses;

use \Response\ResponseAbstract;

/**
 * The class which represents a redirect response which points the client to a new location.
 */
class RedirectResponse extends ResponseAbstract
{
	/**
	 * The status code for 'Moved Permanently'.
	 *
	 * @var int
	 */
	const CODE_MOVED_PERMANENTLY = 301;

	/**
	 * The status code for 'Found'.
	 *
	 * @var int
	 */
	const CODE_FOUND = 302;

	/**
	 * The status code for 'See Other'.
	 *
	 * @var int
	 */
	const CODE_SEE_OTHER = 303;

	/**
	 * The location (URL) where to point the client to.
	 *
	 * @var string
	 */
	private $location;

	/**
	 * Initialize a new RedirectResponse.
	 *
	 * @param int $statusCode
	 * @param string $location
	 */
	public function __construct($statusCode, $location)
	{
		parent::__construct($statusCode);

		$this->setLocation($location);
	}

	/**
	 * Execute the logic of the response. This MAY break the continuation of the code.
	 *
	 * @return void
	 */
	public function execute()
	{
		http_response_code($this->getStatusCode());
		header("Location: {$this->getLocation()}");
	}

	/**
	 * Get the location (URL) where to point the client to.
	 *
	 * @return string
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * Set the location (URL) where to point the client to.
	 *
	 * @param string $location
	 * @throws \InvalidArgumentException When $location is invalid.
	 * @return static
	 */
	private function setLocation($location)
	{
		if (is_string($location) === false) {
			throw new \InvalidArgumentException(
				'Expected location to be of type string, got: '
				. var_export($location)
			);
		}

		$this->location = $location;

		return $this;
	}
}