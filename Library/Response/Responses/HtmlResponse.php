<?php
/**
 * Represents the response for outputting HTML.
 *
 * @package Response
 * @subpackage Responses
 */

namespace Response\Responses;

use \Response\ResponseAbstract;

/**
 * The class which represents the response for outputting HTML.
 */
class HtmlResponse extends ResponseAbstract
{
	/**
	 * The HTML content to send as message.
	 *
	 * @var string
	 */
	private $content;

	/**
	 * Initialize a new HtmlResponse.
	 *
	 * @param int $statusCode
	 * @param string $content
	 */
	public function __construct($statusCode = 200, $content)
	{
		parent::__construct($statusCode);

		$this->setContent($content);
	}

	/**
	 * Execute the logic of the response. This MAY break the continuation of the code.
	 *
	 * @return void
	 */
	public function execute()
	{
		header("Content-Type: text/html; charset=utf-8");

		echo $this->getContent();
	}

	/**
	 * Get the HTML content to send as message.
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set the HTML content to send as message.
	 *
	 * @param string $content
	 * @return static
	 */
	private function setContent($content)
	{
		if (is_string($content) === false) {
			throw new \InvalidArgumentException(
				'Expected content to be of type string, got: '
				. var_export($content, true)
			);
		}

		$this->content = $content;

		return $this;
	}
}