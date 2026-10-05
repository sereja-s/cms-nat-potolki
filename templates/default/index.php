<section class="page__main-slider main-slider">
	<div class="main-slider__container _container">
		<div class="main-slider__body">
			<div class="main-slider__content content-main">
				<h1 class="content-main__title"><?= $this->set['name'] ?></h1>
				<div class="content-main__text">
					<?= $this->set['keywords'] ?>
				</div>
				<a href="<?= $this->alias('catalog') ?>" data-da=".main-slider__body,991.98" class="content-main__button btn">Весь ассортимент</a>
			</div>
			<div class="main-slider__slider slider-main">
				<!-- <div class="slider-main__controls controls-slider-main">
					<div class="controls-slider-main__dotts"></div>
					<div class="controls-slider-main__arrows slider-arrows">
						<button type="button" class="slider-arrow slider-arrow_prev _icon-arrow-down"></button>
						<button type="button" class="slider-arrow slider-arrow_next _icon-arrow-down"></button>
					</div>
				</div> -->
				<div class="slider-main__body _swiper">

					<?php if (!empty($sales)) : ?>

						<?php foreach ($sales as $item) : ?>

							<div class="slider-main__slide">
								<div class="slider-main__image _ibg">

									<img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">

								</div>
								<a href="#" data-swiper-parallax-opacity="0" data-swiper-parallax-x="-100%" class="slider-main__content">
									<div class="slider-main__title"><?= $item['name'] ?></div>
									<div class="slider-main__text"><?= $item['short_content'] ?></div>
									<!-- <div class="slider-main__price _icon-arrow-link">Rp 17.000.000</div> -->
								</a>
							</div>

						<?php endforeach; ?>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php if (!empty($advantages)) : ?>

	<section class="page__advantages advantages">
		<div class="advantages__container _container">

			<?php foreach ($advantages as $item) : ?>

				<div class="advantages__item">
					<div class="advantages__icon">
						<img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">
					</div>
					<h3 class="advantages__title"><?= $item['name'] ?></h3>
					<div class="advantages__text"><?= $item['short_content'] ?></div>
				</div>

			<?php endforeach; ?>

		</div>
	</section>

<?php endif; ?>

<?php if (!empty($goods) && !empty($arrHits)) : ?>

	<section class="page__products products">
		<div class="products__container _container">

			<?php foreach ($arrHits as $key => $value) : ?>

				<?php if (!empty($goods[$key])) : ?>

					<h2 class="products__title _title"><?= $value['name'] ?></h2>
					<div class="products__items">

						<?php foreach ($goods[$key] as $item) {

							$this->showGoods($item);
						} ?>

					</div>

				<?php endif; ?>

			<?php endforeach; ?>

			<div class="products__footer">
				<a href="<?= $this->alias('catalog') ?>" class="products__more-1 btn btn_white">КАТАЛОГ</a>
			</div>

		</div>
	</section>

<?php endif; ?>

<?php if (!empty($rooms)) : ?>

	<section class="page__rooms rooms">
		<div class="rooms__container _container">
			<div class="rooms__body" id="text">
				<h2 class="rooms__title _title"><?= $this->set['short_content'] ?></h2>
				<div class="rooms__text"><?= $this->set['description'] ?></div>
				<a href="tel:<?= preg_replace('/[^+\d]/', '', $this->set['phone']) ?>" class="content-main__button btn"><?= $this->set['phone'] ?></a>
			</div>
			<div class="rooms__slider slider-rooms">
				<div class="slider-rooms__body _swiper">

					<?php foreach ($rooms as $item) : ?>

						<div class="slider-rooms__slide">
							<div class="slider-rooms__image _ibg">
								<img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">
							</div>
							<div data-swiper-parallax-opacity="0" data-swiper-parallax-y="-100%" class="slider-rooms__content _icon-arrow-link">
								<div class="slider-rooms__label label-slider">
									<!-- <div class="label-slider__number">01</div>
									<div class="label-slider__line"></div> -->
									<div class="content-main__text"><?= $item['short_content'] ?></div>
								</div>
								<div class="slider-rooms__title"><?= $item['name'] ?></div>
							</div>
						</div>

					<?php endforeach; ?>

				</div>
				<div class="slider-tips__arrows slider-arrows">
					<button type="button" class="slider-arrow slider-arrow_white slider-arrow_prev _icon-arrow-down"></button>
					<button type="button" class="slider-arrow slider-arrow_white slider-arrow_next _icon-arrow-down"></button>
				</div>
				<div class="slider-rooms__dotts"></div>
			</div>
		</div>
	</section>

<?php endif; ?>

<?php if (!empty($tips)) : ?>

	<section class="page__tips tips">
		<div class="tips__container _container">
			<h2 class="tips__title _title"><?= $this->set['meta_name'] ?></h2>
			<div class="tips__slider slider-tips">
				<div class="slider-tips__body _swiper">

					<?php foreach ($tips as $item) : ?>

						<div class="slider-tips__slide">
							<div class="slider-tips__image _ibg">
								<img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">
							</div>
							<div class="slider-tips__content">
								<div class="slider-tips__title"><?= $item['name'] ?></div>
								<div class="slider-tips__text"><?= $item['short_content'] ?></div>
							</div>
						</div>

					<?php endforeach; ?>

				</div>
				<div class="slider-tips__dotts"></div>
				<div class="slider-tips__arrows slider-arrows">
					<button type="button" class="slider-arrow slider-arrow_white slider-arrow_prev _icon-arrow-down"></button>
					<button type="button" class="slider-arrow slider-arrow_white slider-arrow_next _icon-arrow-down"></button>
				</div>
			</div>
		</div>
	</section>

<?php endif; ?>

<?php if (!empty($questions)) : ?>

	<section8 class="page-eight eight">
		<div class="eight__container">

			<h2 class="title blog__title" style="text-align: center; font-size: 28px; font-weight:700">Часто задаваемые вопросы:</h2>

			<div class="eight__rightside">
				<div data-spollers class="spollers">

					<?php foreach ($questions as $item) : ?>

						<div class="spollers__item">
							<button type="button" data-spoller class="spollers__title"><?= $item['name'] ?></button>
							<div class="spollers__body"><?= $item['content'] ?></div>
						</div>

					<?php endforeach; ?>

				</div>
			</div>

		</div>
	</section8>

<?php endif; ?>

<div class="s-content" style="margin: 35px 0">
	<div class="content-block _container">
		<p class="text-attention"><?= $this->set['meta_title'] ?> заказать в Донецке, Макеевке ДНР. Натяжные потолки в Донецке, Макеевке, ДНР. Цены доступные, Сообщим о наличии полотна и рассчитаем итоговую цену под ваш проект. Работаем оперативно и без скрытых доплат.</p>

		<p class="text"> Обращаем Ваше внимание на то, что данный интернет-сайт носит исключительно информационный характер и ни при каких условиях информационные материалы и цены, размещенные на сайте, не являются публичной офертой, определяемой положениями статьи 437 Гражданского кодекса РФ.</p>
	</div>
</div>