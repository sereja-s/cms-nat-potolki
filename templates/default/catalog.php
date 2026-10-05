<?php if (!empty($data)) :  ?>

	<section class="page__products products">

		<div class="products__container _container">

			<h1 class="products__title-cat _title"><?= $data['name'] ?></h1>




			<?php if (!empty($data['short_content'])) : ?>

				<div class="catalog-internal">
					<?= $data['short_content'] ?>
				</div>

			<?php endif; ?>


			<?php if (!empty($goods)) : ?>

				<div style="margin-bottom: 20px;">

					<nav class="menu__body-cat">

						<ul data-spollers="768,max" class="menu__list">

							<?php if (!empty($this->menu['catalog'])) : ?>

								<li class="menu__item">

									<?php if (!empty($order)) : ?>

										<button data-spoller type="button" class="menu__link-cat">Сортировать по:</button>
										<ul style="min-width: auto;" class="menu__sub-list">

											<?php

											$GET = $_GET ?? [];

											?>

											<?php foreach ($order as $name => $item) : ?>

												<li class="menu__sub-item">
													<a href="<?= $this->alias('catalog/' . ($this->parameters['alias'] ?? ''), array_merge($GET, ['order' => $item])) ?>" class="menu__sub-link"><?= $name ?></a>
												</li>

											<?php endforeach; ?>

										</ul>

									<?php endif; ?>

								</li>

							<?php endif; ?>

							<?php if (!empty($quantities)) : ?>

								<li class="menu__item pagination__count">
									<!-- <a href="#" class="menu__link">Показывать по</a> -->
									<button data-spoller type="button" class="menu__link-cat">Показывать по: <span><?= $_SESSION['quantities'] ?? QTY ?></span></button>
									<ul style="min-width: auto;" class="menu__sub-list">

										<?php foreach ($quantities as $item) : ?>

											<li class="menu__sub-item qtyitems">
												<a href="#" class="menu__sub-link"><?= $item ?></a>
											</li>

										<?php endforeach; ?>

									</ul>
								</li>

							<?php endif; ?>

						</ul>
					</nav>

				</div>

				<div class="products__items">

					<?php foreach ($goods as $item) {

						$this->showGoods($item);
					} ?>

				</div>

				<?php if (!empty($pages)) : ?>

					<div class="pagination" style="padding-top: 35px;">

						<?php $this->pagination($pages) ?>

					</div>

				<?php endif; ?>

			<?php endif; ?>

			<?php if (!empty($data['main_img'])) :  ?>

				<img src="<?= $this->img($data['main_img']) ?>" alt="<?= $data['main_img'] ?>" style="display: block; margin: 2rem auto 0.5rem auto; max-width: 100%; height: auto;">

			<?php endif; ?>

			<?php if ($data['name'] !== $this->set['meta_title']) : ?>

				<section class="plant__body plant">
					<div class="plant__container">
						<div class="plant__content">
							<h3 class="plant__title"><?= $data['name'] . ' Донецк, Макеевка ДНР' ?></h3>
							<div class="plant__text">
								<?= $data['content'] ?>
							</div>
						</div>
						<div class="plant__related related-plant">
							<div class="related-plant__body">
								<div class="related-plant__item how">
									<div class="how__body how__body_h ">
										<div class="how__info">
											<h4 class="how__title how__title_l sub-title"><?= ' Заказать ' . $data['name'] . ' в Донецке, Макеевке ДНР' ?></h4>
											<div class="how__text how__text_l"><?= $data['keywords'] ?></div>
										</div>
										<!-- <a href="mailto:<?= $this->set['email'] ?>" class="how__button btn btn_w">Написать на эл.почту</a> -->
									</div>
									<div class="plant__image">
										<img src="<?= $this->img($data['img']) ?>" alt="<?= $data['name'] ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

			<?php endif; ?>

			<div class="s-content" style="margin-top: 35px">
				<div class="content-block">
					<p class="text-attention"><?= ($data['name'] !== 'Каталог') ? $data['name'] : $this->set['keywords'] ?> заказать в Донецке, Макеевке ДНР. Натяжные потолки в Донецке, Макеевке, ДНР. Цены доступные, Сообщим о наличии полотна и рассчитаем итоговую цену под ваш проект. Работаем оперативно и без скрытых доплат.</p>
					<!-- <h3 class="title-block">Беговелы для детей</h3> -->
					<p class="text"> Обращаем Ваше внимание на то, что данный интернет-сайт носит исключительно информационный характер и ни при каких условиях информационные материалы и цены, размещенные на сайте, не являются публичной офертой, определяемой положениями статьи 437 Гражданского кодекса РФ.</p>
				</div>
			</div>

		</div>

	</section>


<?php endif; ?>