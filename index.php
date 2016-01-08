<?php
session_start();
require_once 'autoload.php';

use \Context\Context;
use \Response\Responses\RedirectResponse;
use \State\StateMachine;
use \State\States\CustomerDetailsState;
use \State\States\PaymentMethodState;
use \State\States\ThankYouState;

// Set up the state machine.
$stateMachine = new StateMachine();
$stateMachine->addState(new CustomerDetailsState());
$stateMachine->addState(new PaymentMethodState());
$stateMachine->addState(new ThankYouState());

// Get or create the context.
$context = (array_key_exists('context', $_SESSION))
	? unserialize($_SESSION['context'])
	: $context = new Context();

// Get the requested state.
$requestedState = (array_key_exists('state', $_GET))
	? $_GET['state']
	: '';

// Invoke the state if there is a state, otherwise redirect to the latest state.
if ($requestedState !== '') {
	$response = $stateMachine->invokeState($requestedState, $context);
} else {
	$latestState = $stateMachine->getLatestState($context);
	$response = $response = new RedirectResponse(
		RedirectResponse::CODE_SEE_OTHER,
		$latestState::createUrl()
	);
}

// Store the latest version of the context.
$_SESSION['context'] = serialize($context);

// Execute the response of the state.
$response->execute();