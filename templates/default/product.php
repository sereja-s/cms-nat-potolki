<?php if (!empty($data)) :  ?>

	<section class="page__products products">

		<div class="products__container _container">
			<h1 class="products__title-cat _title"><?= $data['name'] ?></h1>
			<div class="products__items">
				<div class="products__item item-product">
					<div class="item-product__image _ibg">
						<img src="<?= $this->img($data['img']) ?>" alt="<?= $data['name'] ?>">
					</div>
					<div class="item-product__body">
						<div class="item-product__content">
							<h3 class="item-product__title"><?= $data['name'] ?></h3>
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

							<?php if ($data['content']) : ?>

								<div class="item-product__text" style="padding-top: 15px;"><?= $data['content'] ?></div>

							<?php endif; ?>

						</div>

					</div>
				</div>
			</div>

			<div class="s-content" style="margin-top: 35px">
				<div class="content-block">
					<p class="text-attention"><?= $data['name'] ?> заказать в Донецке, Макеевке ДНР. Натяжные потолки в Донецке, Макеевке, ДНР. Цены доступные, Сообщим о наличии полотна и рассчитаем итоговую цену под ваш проект. Работаем оперативно и без скрытых доплат.</p>
					<!-- <h3 class="title-block">Беговелы для детей</h3> -->
					<p class="text"> Обращаем Ваше внимание на то, что данный интернет-сайт носит исключительно информационный характер и ни при каких условиях информационные материалы и цены, размещенные на сайте, не являются публичной офертой, определяемой положениями статьи 437 Гражданского кодекса РФ.</p>
				</div>
			</div>

		</div>

	</section>

<?php endif; ?>