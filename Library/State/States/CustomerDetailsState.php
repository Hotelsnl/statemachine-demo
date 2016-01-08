<?php
/**
 * Represents the state for the customer details.
 *
 * @package State
 * @subpackage States
 */

namespace State\States;

use \Context\Context;
use \Response\ResponseInterface;
use \Response\Responses\HtmlResponse;
use \Response\Responses\RedirectResponse;
use \State\StateAbstract;

/**
 * The class which represents the state for the customer details.
 */
class CustomerDetailsState extends StateAbstract
{
	/**
	 * The unique identifier of a state.
	 *
	 * @return string
	 */
	public static function identifier()
	{
		return 'customer-details';
	}

	/**
	 * Invoke the state.
	 *
	 * @param Context $context
	 * @return ResponseInterface
	 */
	public function invoke(Context $context)
	{
		$this->processInputData($context);

		ob_start();
		include('Resources/customer-details.php');
		$content = ob_get_clean();

		if ($_SERVER['REQUEST_METHOD'] === 'POST'
			&& $this->isValid($context)
		) {
			$response = new RedirectResponse(
				RedirectResponse::CODE_SEE_OTHER,
				'/'
			);
		} else {
			$response = new HtmlResponse(200, $content);
		}

		return $response;
	}

	/**
	 * Process the input data and write to the context.
	 *
	 * @param Context $context
	 * @return void
	 */
	protected function processInputData(Context $context)
	{
		foreach ($_POST as $fieldName => $value) {
			switch ($fieldName) {
				case 'firstname':
					$context->setFirstName($value);
					break;
				case 'lastname':
					$context->setLastName($value);
					break;
			}
		}
	}

	/**
	 * Whether the state is applicable.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isApplicable(Context $context)
	{
		return $context->isMutable();
	}

	/**
	 * Whether the state is valid.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isValid(Context $context)
	{
		$firstName = $context->getFirstName();
		$lastName = $context->getLastName();

		return empty($firstName) === false
			&& empty($lastName) === false;
	}

	/**
	 * Whether the state is complete.
	 *
	 * @param Context $context
	 * @return boolean
	 */
	public function isComplete(Context $context)
	{
		return $this->isValid($context);
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