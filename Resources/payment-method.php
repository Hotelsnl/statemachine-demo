<?php
/** @var \Context\Context $context */

$paymentMethod = $context->getPaymentMethod();
?>
<h1>Payment method</h1>

<form method="post" action="">
	<p>
		Payment method:<br />
		<label>
			<input type="radio" name="paymentmethod" value="cod" <?= ($paymentMethod === 'cod') ? 'checked="checked"' : '' ?> /> Cash on delivery<br />
		</label>
		<label>
			<input type="radio" name="paymentmethod" value="coupon" <?= ($paymentMethod === 'coupon') ? 'checked="checked"' : '' ?> /> Coupon
		</label>
	</p>

	<p>
		<input type="submit" value="Next" />
	</p>
</form>

<? include('Resources/includes/previous-link.php') ?>