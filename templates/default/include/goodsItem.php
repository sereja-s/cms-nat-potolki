<!-- карточка товара -->

<?php if (!empty($data)) : ?>

	<a href="<?= $this->alias(['product' => $data['alias']]) ?>" class="products__item item-product">

		<div class="item-product__labels">

			<?php if (!empty($data['new'])) : ?>

				<div class="item-product__label item-product__label_new">Новинка</div>

			<?php endif; ?>

			<?php if (!empty($data['discount'])) : ?>

				<div class="item-product__label item-product__label_sale">-<?= $data['discount'] ?>%</div>

			<?php endif; ?>

		</div>

		<div class="item-product__labels--prem">

			<?php if (!empty($data['hit'])) : ?>

				<div class="item-product__label--prem">Хит продаж</div>

			<?php endif; ?>

		</div>

		<div class="item-product__image _ibg">
			<img src="<?= $this->img($data['img']) ?>" alt="<?= $data['name'] ?>">
		</div>
		<div class="item-product__body">
			<div class="item-product__content">
				<h2 class="item-product__title"><?= $data['name'] ?></h2>
				<div class="item-product__text"><?= $data['short_content'] ?></div>

				<?php if ($data['price'] || $data['price_m_opt']) : ?>

					<div class="item-product__text">Цена:</div>

				<?php endif; ?>

				<?php if ($data['price']) : ?>

					<div class="item-product__prices">
						<div class="item-product__price"> от <?= $data['price'] ?> руб./м²</div>
						<!-- <div class="item-product__price item-product__price_old"></div> -->
					</div>

				<?php endif; ?>

			</div>
		</div>
	</a>

<?php endif; ?>