<?php if (!empty($infoData)) : ?>
	<div class="_container">
		<h1 style="margin-top: 100px;" class="products__title _title"><?= $infoData['name'] ?? '' ?></h1>
		<div style="margin-bottom: 35px;" class="catalog-internal">
			<?= $infoData['content'] ?? '' ?>
		</div>
	</div>
<?php endif; ?>