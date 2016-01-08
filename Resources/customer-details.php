<?php
/** @var \Context\Context $context */
?>
<h1>Customer details</h1>

<form method="post" action="">
	<p>
		First name:<br />
		<input type="text" name="firstname" value="<?= htmlentities($context->getFirstName(), ENT_QUOTES) ?>" />
	</p>

	<p>
		Last name:<br />
		<input type="text" name="lastname" value="<?= htmlentities($context->getLastName(), ENT_QUOTES) ?>" />
	</p>

	<p>
		<input type="submit" value="Next" />
	</p>
</form>

<? include('Resources/includes/previous-link.php') ?>
