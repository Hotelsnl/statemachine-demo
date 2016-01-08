<?php
/**
 * The interface of a state.
 *
 * @package State
 * @subpackage StateInterface
 */

namespace State;

use \Context\Context;
use \Response\ResponseInterface;

/**
 * The interface of a state.
 */
interface StateInterface
{
	/**
	 * Create the URL to the concrete state.
	 *
	 * @return string
	 */
	public static function createUrl();

	/**
	 * The unique identifier of a state.
	 *
	 * @return string
	 */
	public static function identifier();

	/**
	 * Get the unique identifier of the state.
	 *
	 * @return string
	 */
	public function getIdentifier();

	/**
	 * Get the URL to the previous state.
	 *
	 * @return string
	 */
	public function getPreviousUrl();

	/**
	 * Set the URL to the previous state.
	 *
	 * @param string $previousUrl
	 * @throws \InvalidArgumentException When $previousUrl is not of type string.
	 */
	public function setPreviousUrl($previousUrl);

	/**
	 * Invoke the state.
	 *
	 * @param Context $context
	 * @return ResponseInterface
	 */
	public function invoke(Context $context);

	/**
	 * Whether the state is applicable.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isApplicable(Context $context);

	/**
	 * Whether the state is valid.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isValid(Context $context);

	/**
	 * Whether the state is complete.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isComplete(Context $context);

	/**
	 * Whether the state is visitable.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isVisitable(Context $context);
}