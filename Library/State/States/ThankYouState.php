<?php
/**
 * Represents the state for the thank you.
 *
 * @package State
 * @subpackage States
 */

namespace State\States;

use \Context\Context;
use \Response\ResponseInterface;
use \Response\Responses\HtmlResponse;
use \State\StateAbstract;

/**
 * The class which represents the state for the thank you.
 */
class ThankYouState extends StateAbstract
{
	/**
	 * The unique identifier of a state.
	 *
	 * @return string
	 */
	public static function identifier()
	{
		return 'thank-you';
	}

	/**
	 * Invoke the state.
	 *
	 * @param Context $context
	 * @return ResponseInterface
	 */
	public function invoke(Context $context)
	{
		$context->setMutable(false);

		ob_start();
		include('Resources/thank-you.php');
		$content = ob_get_clean();

		return new HtmlResponse(200, $content);
	}

	/**
	 * Whether the state is applicable.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isApplicable(Context $context)
	{
		return true;
	}

	/**
	 * Whether the state is valid.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isValid(Context $context)
	{
		return true;
	}

	/**
	 * Whether the state is complete.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isComplete(Context $context)
	{
		return true;
	}

	/**
	 * Whether the state is visitable.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isVisitable(Context $context)
	{
		return true;
	}
}