</main>
<footer class="footer">
	<div class="footer__container _container">
		<div class="footer__body">
			<div class="footer__main">
				<a href="<?= $this->alias() ?>" class="footer__logo _footer-title"><?= $this->set['name'] ?></a>
				<div class="footer__text"><?= $this->set['short_content'] ?></div>
				<div class="footer__contacts contacts-footer">

					<?php if (!empty($this->address)) : ?>

						<ul>

							<?php foreach ($this->address as $adres) : ?>

								<li>

									<div class="contacts-footer__item _icon-location"><?= $adres['name'] ?></div>

								</li>

							<?php endforeach; ?>

						</ul>

					<?php endif; ?>

					<?php if (!empty($this->phones)) : ?>

						<ul>

							<?php foreach ($this->phones as $phone) : ?>

								<li>

									<a href="tel:<?= preg_replace('/[^\+\d]/', '', $phone['name']) ?>" class="contacts-footer__item _icon-phone"><?= $phone['name'] ?></a>

								</li>

							<?php endforeach; ?>

						</ul>

					<?php endif; ?>

					<?php if (!empty($this->emails)) : ?>

						<ul>

							<?php foreach ($this->emails as $email) : ?>

								<li>

									<a href="mailto:<?= $email['name'] ?>" target="_blank" class="contacts-footer__item"><?= $email['name'] ?></a>

								</li>

							<?php endforeach; ?>

						</ul>

					<?php endif; ?>

				</div>
			</div>
			<div data-spollers="767,max" class="footer__menu menu-footer">
				<div class="menu-footer__column">

					<?php if (!empty($this->menu['catalog'])) : ?>

						<button type="button" data-spoller class="menu-footer__title _footer-title">Продукция</button>
						<ul class="menu-footer__list">



							<?php foreach ($this->menu['catalog'] as $item) : ?>

								<li><a href="<?= $this->alias(['catalog' => $item['alias']]) ?>" class="menu-footer__link"><?= $item['name'] ?></a></li>

							<?php endforeach; ?>


						</ul>

					<?php endif; ?>

				</div>
				<div class="menu-footer__column">

					<?php if (!empty($this->menu['information-bottom'])) : ?>

						<button type="button" data-spoller class="menu-footer__title _footer-title">Информация</button>
						<ul class="menu-footer__list">

							<?php foreach ($this->menu['information-bottom'] as $item) : ?>

								<li><a href="<?= $this->alias(['information' => $item['alias']]) ?>" class="menu-footer__link"><?= $item['name'] ?></a></li>

							<?php endforeach; ?>

						</ul>

					<?php endif; ?>

				</div>
				<div class="menu-footer__column">

					<?php if (!empty($this->socials)) : ?>

						<button type="button" data-spoller class="menu-footer__title _footer-title">Соц.сети</button>
						<ul class="menu-footer__list">

							<?php foreach ($this->socials as $item) : ?>

								<li><a href="<?= $this->alias($item['external_alias']) ?>" class="menu-footer__link"><?= $item['name'] ?></a></li>

							<?php endforeach; ?>

							<!-- <li><a href="" class="menu-footer__link">Instagram</a></li> -->

						</ul>

					<?php endif; ?>

				</div>
			</div>
			<div class="footer__subscribe subscribe">

				<a href="<?= $this->alias() ?>" class="header__logo"><img src="<?= $this->img($this->set['img']) ?>" alt="<?= $this->set['name'] ?>"></a>

			</div>
		</div>
	</div>
</footer>
</div>
<div class="popup popup_popup">
	<div class="popup__content">
		<div class="popup__body">
			<div class="popup__close"></div>
		</div>
	</div>
</div>
<div class="popup popup_subscribe-message">
	<div class="popup__content">
		<div class="popup__body">
			<div class="popup__close"></div>
		</div>
	</div>
</div>
<div class="popup popup_video">
	<div class="popup__content">
		<div class="popup__body">
			<div class="popup__close popup__close_video"></div>
			<div class="popup__video _video"></div>
		</div>
	</div>
</div>

<div class="_container">
	<div class="ml_wrapper">
		<input type="checkbox" class="ml_btn_input" id="ml_btn_input">
		<label for="ml_btn_input" class="ml_btn_label">

			<span style="background-image: url('<?= PATH . TEMPLATE ?>assets/img/sw.png'); background-size: 57%;" class="ml_bgimg"></span>

			<span style="background-image: url('<?= PATH . TEMPLATE ?>assets/img/vn.png'); background-size: 100%;" class=" ml_bgimg ml_icon ml_icon-close"></span>
		</label>

		<?php if (!empty($this->set['external_alias_max'])) : ?>

			<a class="ml_icon ml_icon_link" href="<?= $this->set['external_alias_max'] ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000">
					<defs>
						<linearGradient id="b">
							<stop offset="0" stop-color="#00f" />
							<stop offset="1" stop-opacity="0" />
						</linearGradient>
						<linearGradient id="a">
							<stop offset="0" stop-color="#4cf" />
							<stop offset=".662" stop-color="#53e" />
							<stop offset="1" stop-color="#93d" />
						</linearGradient>
						<linearGradient id="c" x1="117.847" x2="1000" y1="760.536" y2="500" gradientUnits="userSpaceOnUse" href="#a" />
						<radialGradient id="d" cx="-87.392" cy="1166.116" r="500" fx="-87.392" fy="1166.116" gradientTransform="rotate(51.356 1551.478 559.3)scale(2.42703433 1)" gradientUnits="userSpaceOnUse" href="#b" />
					</defs>
					<rect width="1000" height="1000" fill="url(#c)" ry="249.681" />
					<rect width="1000" height="1000" fill="url(#d)" ry="249.681" />
					<path fill="#fff" fill-rule="evenodd" d="M508.211 878.328c-75.007 0-109.864-10.95-170.453-54.75-38.325 49.275-159.686 87.783-164.979 21.9 0-49.456-10.95-91.248-23.36-136.873-14.782-56.21-31.572-118.807-31.572-209.508 0-216.626 177.754-379.597 388.357-379.597 210.785 0 375.947 171.001 375.947 381.604.707 207.346-166.595 376.118-373.94 377.224m3.103-571.585c-102.564-5.292-182.499 65.7-200.201 177.024-14.6 92.162 11.315 204.398 33.397 210.238 10.585 2.555 37.23-18.98 53.837-35.587a189.8 189.8 0 0 0 92.71 33.032c106.273 5.112 197.08-75.794 204.215-181.95 4.154-106.382-77.67-196.486-183.958-202.574Z" clip-rule="evenodd" />
				</svg>
			</a>

		<?php endif; ?>

		<?php if (!empty($this->set['external_alias_tel'])) : ?>

			<a class="ml_icon ml_icon_link" href="<?= $this->set['external_alias_tel'] ?>">
				<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M25 50C38.8071 50 50 38.8071 50 25C50 11.1929 38.8071 0 25 0C11.1929 0 0 11.1929 0 25C0 38.8071 11.1929 50 25 50Z" fill="#0087D0"></path>
					<path d="M36.11 13.0399L9.40999 22.7999C8.86999 22.9999 8.85999 23.7999 9.38999 24.0299L16.23 26.7199L18.78 34.4099C18.93 34.8199 19.47 34.9599 19.81 34.6799L23.73 31.1899L31.17 35.9099C31.55 36.1499 32.06 35.9399 32.15 35.5099L36.99 13.7599C37.09 13.2799 36.59 12.8699 36.11 13.0599V13.0399ZM20.03 28.1599L19.6 32.1199L17.53 26.0299L32.1 16.8699L20.03 28.1699V28.1599Z" fill="white"></path>
				</svg></a>

		<?php endif; ?>

		<a class="ml_icon ml_icon_link" href="tel:<?= preg_replace('/[^+\d]/', '', $this->set['phone']) ?>">
			<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M25 43C34.9411 43 43 34.9411 43 25C43 15.0589 34.9411 7 25 7C15.0589 7 7 15.0589 7 25C7 34.9411 15.0589 43 25 43Z" fill="white"></path>
				<path d="M25 0C11.194 0 0 11.194 0 25C0 38.806 11.194 50 25 50C38.806 50 50 38.806 50 25C50 11.194 38.806 0 25 0ZM24.063 12.977C24.247 12.973 24.439 13.002 24.604 13.002C24.671 13.002 24.734 12.996 24.787 12.982C30.735 13.198 35.924 18.605 35.817 24.552C35.817 25.092 36.033 25.958 35.167 25.958C34.302 25.958 34.519 25.093 34.519 24.444C34.4326 23.7048 34.3034 22.9712 34.132 22.247C33.9787 21.5995 33.7772 20.9644 33.529 20.347C33.1967 19.5117 32.7468 18.7281 32.193 18.02C30.586 15.991 28.146 14.827 24.679 14.28C24.139 14.173 23.381 14.28 23.381 13.632C23.381 13.069 23.705 12.977 24.063 12.977V12.977ZM32.248 24.768C31.275 24.877 31.49 24.011 31.383 23.471C30.733 19.686 29.436 18.281 25.544 17.415C25.004 17.307 24.139 17.415 24.246 16.551C24.355 15.686 25.219 16.011 25.761 16.119C29.653 16.551 32.789 19.794 32.789 23.471C32.681 23.903 33.005 24.661 32.249 24.769L32.248 24.768ZM29.869 22.823C29.869 23.255 29.869 23.795 29.22 23.903C28.788 23.903 28.571 23.579 28.463 23.147C28.355 21.525 27.489 20.66 25.868 20.443C25.436 20.335 24.895 20.227 25.11 19.577C25.22 19.145 25.65 19.145 26.085 19.145C27.923 19.038 29.869 20.984 29.869 22.823ZM35.924 34.718C35.275 36.556 33.004 38.394 31.058 38.394C30.842 38.286 30.301 38.286 29.761 38.069C21.327 34.393 15.055 28.445 11.594 19.795C10.404 16.983 11.702 14.497 14.623 13.523C14.8797 13.4163 15.155 13.3613 15.433 13.3613C15.711 13.3613 15.9863 13.4163 16.243 13.523C17.542 13.956 20.677 18.39 20.786 19.687C20.893 20.767 20.136 21.308 19.488 21.741C18.19 22.607 18.19 23.796 18.731 24.985C20.029 27.797 22.191 29.635 24.894 30.933C25.868 31.365 26.841 31.365 27.49 30.283C28.679 28.445 30.193 28.445 31.815 29.635C32.572 30.175 33.436 30.716 34.193 31.365C35.276 32.23 36.573 32.986 35.924 34.717V34.718Z" fill="#06cf06"></path>
			</svg></a>
	</div>
</div>

<!-- Swiper -->
<!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
<!-- <script src="js/vendors.min.js"></script>
<script src="js/app.min.js"></script> -->
<script>
	var ForJS = {};
	/* укажем для описания полного пути к маркеру(картинки-лого) на карте */
	/* Остальное описано в main.js  */
	ForJS.imgMap = '<?= $this->img($this->set['main_img']) ?>';
</script>

<?php $this->getScripts() ?>

</body>

</html>