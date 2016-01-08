<?php
/**
 * Represents the state machine handling states.
 *
 * @package State
 * @subpackage StateMachine
 */

namespace State;

use \Context\Context;
use \Response\ResponseInterface;
use Response\Responses\RedirectResponse;

/**
 * The class which represents the state machine handling states.
 */
class StateMachine
{
	/**
	 * The registered states.
	 *
	 * @var StateInterface[]
	 */
	private $states = array();

	/**
	 * Invoke a state.
	 *
	 * @param string $identifier
	 * @param Context $context
	 * @return ResponseInterface
	 * @throws \RuntimeException When $identifier is not registered.
	 */
	public function invokeState($identifier, Context $context)
	{
		if ($this->isStateRegistered($identifier) === false) {
			throw new \RuntimeException(
				"State '{$identifier}' is not registered."
			);
		}

		$state = $this->getState($identifier);

		// Check if the state is accessible, otherwise redirect to the first accessible state.
		if ($this->isStateAccessible($state, $context) === false) {
			$availableState = $this->getLatestState($context);

			$response = new RedirectResponse(
				RedirectResponse::CODE_SEE_OTHER,
				$availableState::createUrl()
			);
		} else {
			$previousState = $this->getPreviousState($state, $context);

			if ($previousState !== null) {
				$state->setPreviousUrl($previousState::createUrl());
			}

			$response = $state->invoke($context);
		}

		return $response;
	}

	/**
	 * Whether the supplied state is accessible.
	 *
	 * @param StateInterface $requestedState
	 * @param Context $context
	 * @return boolean
	 */
	public function isStateAccessible(StateInterface $requestedState, Context $context)
	{
		$isAccessible = false;

		// Loop through the states to validate previous states.
		foreach ($this->getStates() as $state) {
			if ($state->getIdentifier() !== $requestedState->getIdentifier()) {
				if ($state->isApplicable($context)
					&& (
						$state->isComplete($context) === false
						|| $state->isValid($context) === false
					)
				) {
					break;
				}
			} else {
				$isAccessible = $requestedState->isApplicable($context);
				break;
			}
		}

		return $isAccessible;
	}

	/**
	 * Get the latest accessible state.
	 *
	 * @param Context $context
	 * @return StateInterface
	 * @throws \LogicException When there is no accessible state.
	 */
	public function getLatestState(Context $context)
	{
		$accessibleState = null;

		foreach ($this->getStates() as $state) {
			if ($state->isApplicable($context)) {
				$accessibleState = $state;
			} else {
				// Don't mind about validity and completed when the state is not
				// applicable.

				continue;
			}

			// Halt when the given state is not (yet) completed or valid.
			if ($state->isComplete($context) === false
				|| $state->isValid($context) === false
			) {
				break;
			}
		}

		if ($accessibleState === null) {
			throw new \LogicException(
				'Unable to get latest state, not accessible state.'
			);
		}

		return $accessibleState;
	}

	/**
	 * Get the previous visitable state.
	 *
	 * @param StateInterface $state
	 * @param Context $context
	 * @return null|StateInterface
	 */
	public function getPreviousState(StateInterface $state, Context $context)
	{
		$previousState = null;

		foreach ($this->getStates() as $registeredState) {
			// Stop when we hit the current state, it indicates that
			// there is no previous state.
			if ($state->getIdentifier() === $registeredState->getIdentifier()) {
				break;
			}

			// Go to the next state if the state is not applicable.
			if ($registeredState->isApplicable($context) === false) {
				continue;
			}

			// If the state is visitable, we can mark it as a previous state.
			if ($registeredState->isVisitable($context) === true) {
				$previousState = $registeredState;
			}
		}

		return $previousState;
	}

	/**
	 * Add a new state.
	 *
	 * @param StateInterface $state
	 * @return static
	 * @throws \InvalidArgumentException When $state is already registered.
	 */
	public function addState(StateInterface $state)
	{
		if (array_key_exists($state->getIdentifier(), $this->getStates()) === true ) {
			throw new \InvalidArgumentException(
				"State '{$state->getIdentifier()}' is already registered."
			);
		}

		$this->states[$state->getIdentifier()] = $state;

		return $this;
	}

	/**
	 * Whether a state is registered.
	 *
	 * @param string $identifier
	 * @return boolean
	 */
	public function isStateRegistered($identifier)
	{
		return array_key_exists($identifier, $this->getStates());
	}

	/**
	 * Get a state by its identifier.
	 *
	 * @param string $identifier
	 * @return StateInterface
	 */
	public function getState($identifier)
	{
		if ($this->isStateRegistered($identifier) === false) {
			throw new \InvalidArgumentException(
				"Unable to get state '{$identifier}', state is not registered."
			);
		}

		return $this->states[$identifier];
	}

	/**
	 * Get the registered states.
	 *
	 * @return StateInterface[]
	 */
	public function getStates()
	{
		return $this->states;
	}
}