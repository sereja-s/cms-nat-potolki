<section class="hero">
	<div class="hero__container">
		<h1 class="hero__title"><?= $contacts_page['name'] ?></h1>
	</div>
	<div class="hero__bg">
		<img src="<?= $this->img($contacts_page['img']) ?>" alt="<?= $contacts_page['name'] ?>">
	</div>
</section>

<!-- section-contacts -->
<section style="padding-top: 70px;" class="section-contacts">
	<div class="_container section-contacts__container">

		<div class="contacts">
			<div class="contacts__start map-wrapper">

				<div class="contacts__map" id="ymap" data-coordinates="<?= $contacts_page['data_coordinates'] ?>"
					data-address="<?= $this->set['address'] ?>"></div>
				<p class="page-title sectoin-contacts__title">Для взамодействия с картой, кликните по ней<br>Снова сделать карту неподвижной - кликните в другом месте экрана</p>
			</div>

			<div class="contacts__end">
				<div class="contacts__item">
					<h3 class="category__title _footer-title">Адрес</h3>
					<div class="category__subtitle"><?= $this->set['address'] ?></div>
				</div>
				<div class="contacts__item">
					<h3 class="category__title _footer-title">График работы</h3>
					<div class="category__subtitle"><?= $this->set['working_time'] ?></div>
				</div>
				<div class="contacts__item">
					<h3 class="category__title _footer-title">Телефон</h3>
					<div class="category__subtitle">
						<a class="contacts__phone" href="tel:<?= preg_replace('/[^+\d]/', '', $this->set['phone']) ?>"><?= $this->set['phone'] ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>