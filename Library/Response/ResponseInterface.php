<?php
/**
 * Represents the interface of a response.
 *
 * @package Response
 * @subpackage ResponseInterface
 */

namespace Response;

/**
 * The interface of a response.
 */
interface ResponseInterface
{
	/**
	 * Execute the logic of the response. This MAY break the continuation of the code.
	 *
	 * @return void
	 */
	public function execute();
}