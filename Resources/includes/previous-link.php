<?php
/** @var string $previousUrl */

if (empty($previousUrl) === false) {
?>
	<p>
		<a href="<?= $previousUrl ?>">Previous state</a>
	</p>
<?php
}