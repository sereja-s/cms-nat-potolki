<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php
	// Безопасное получение значений
	$dataName = isset($data['name']) && !empty($data['name']) ? (string)$data['name'] : null;
	$infoDataName = isset($infoData['name']) && !empty($infoData['name']) ? (string)$infoData['name'] : null;
	$currentPage = isset($page) && !empty($page) ? (string)$page : null;


	// Значения по умолчанию
	$defaultDescription = ' Сокровищница вкусов: специи, чай, кофе, восточные сладости, орехи и фрукты. Каждый продукт — это история, которую хочется пробовать снова и снова. Выбирайте лучшее для себя и в подарок!';
	$defaultOgDescription = 'У нас — только отборные специи, ароматный кофе и чай, восточные сладости, орехи и сухофрукты. Каждый продукт бережно подобран, чтобы радовать вкусом и приносить пользу';


	// Формируем description
	if ($dataName) {
		$description = $dataName . ' купить в Донецке, Макеевке ДНР по выгодной цене с доставкой или самовывозом, тел. ' . $this->set['phone'];
		if ($currentPage) {
			$description .= ' - текущая страница ' . $currentPage;
		}
	} elseif (!empty($this->set['meta_description'])) {
		$description = $this->set['meta_description'] . ', тел. ' . $this->set['phone'];
		if ($infoDataName) {
			$description .= ' - ' . $infoDataName;
		}
	} else {
		$description = $defaultDescription;
	}

	// Формируем keywords
	if ($dataName) {
		$keywords = $dataName . ', ' . $this->set['meta_keywords'];
	} else {
		$keywords = $this->set['meta_keywords'];
	}

	// Формируем og:title
	if ($dataName) {
		$ogTitle = $dataName . ' | ' . $this->set['meta_name'];
	} else {
		$ogTitle = $this->set['meta_name'] . ' | ' . $this->set['meta_title'];
		if ($infoDataName) {
			$ogTitle .= ' | ' . $infoDataName;
		}
	}

	// Формируем og:description
	if ($dataName) {
		$ogDescription = $dataName . ' заказать в Донецке, Макеевке, ДНР по выгодной цене с доставкой или самовывозом, тел. ' . $this->set['phone'];
		if ($currentPage) {
			$ogDescription .= '. страница каталога - ' . $currentPage;
		}
	} elseif (!empty($this->set['meta_og_description'])) {
		$ogDescription = $this->set['meta_og_description'] . ', тел. ' . $this->set['phone'];
		if ($infoDataName) {
			$ogDescription .= ' - ' . $infoDataName;
		}
	} else {
		$ogDescription = $defaultOgDescription;
	}

	// Формируем title
	if ($dataName) {
		$title = $dataName;
		if ($currentPage) {
			$title .= ' - страница ' . $currentPage;
		}
		$title .= ' | ' . $this->set['meta_name'];
	} else {
		$title = $this->set['meta_name'] . ' | ' . $this->set['meta_title'];
		if ($infoDataName) {
			$title .= ' | ' . $infoDataName;
		}
	}
	?>

	<meta name="description" content="<?= htmlspecialchars($description) ?>">
	<meta name="keywords" content="<?= htmlspecialchars($keywords) ?>">
	<meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>">
	<meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>">

	<link rel="icon" href="<?= htmlspecialchars(SITE_URL) ?>/favicon.svg" type="image/svg+xml">
	<title><?= htmlspecialchars($title) ?></title>


	<?php $this->getStyles() ?>
</head>

<body>
	<div class="wrapper">
		<header class="header">
			<div class="header__wrapper">
				<div class="header__container _container">
					<div class="header__body">
						<div class="header__main">
							<a href="<?= $this->alias() ?>" class="header__logo"><img src="<?= $this->img($this->set['img']) ?>" alt="<?= $this->set['name'] ?>"></a>
							<div class="header__menu menu">
								<nav class="menu__body">
									<ul data-spollers="768,max" class="menu__list">

										<?php if (!empty($this->menu['catalog'])) : ?>

											<li class="menu__item">

												<button data-spoller type="button" class="menu__link">КАТАЛОГ</button>

												<ul class="menu__sub-list">

													<?php foreach ($this->menu['catalog'] as $item) : ?>

														<li class="menu__sub-item">
															<a href="<?= $this->alias(['catalog' => $item['alias']]) ?>" class="menu__sub-link"><?= $item['name'] ?></a>
														</li>

													<?php endforeach; ?>

												</ul>
											</li>

										<?php endif; ?>

										<?php if (!empty($this->phones)) : ?>

											<li class="menu__item">

												<button data-spoller type="button" class="menu__link-cat">Позвонить</button>

												<ul class="menu__sub-list">

													<?php foreach ($this->phones as $phone) : ?>

														<li class="menu__sub-item">

															<a href="tel:<?= preg_replace('/[^+\d]/', '', $phone['name']) ?>" class="menu__sub-link"><?= $phone['name'] ?></a>

														</li>

													<?php endforeach; ?>

												</ul>

											</li>

										<?php endif; ?>

										<?php if (!empty($this->emails) || !empty($this->socials)) : ?>

											<li class="menu__item">

												<button data-spoller type="button" class="menu__link-cat menu__cat-color">Написать</button>

												<ul class="menu__sub-list">

													<?php if (!empty($this->socials) && is_array($this->socials)) : ?>

														<?php foreach ($this->socials as $item) : ?>

															<li class="menu__sub-item"><a href="<?= $this->alias($item['external_alias']) ?>" class="menu__sub-link"><?= $item['name'] ?></a></li>

														<?php endforeach; ?>

													<?php endif; ?>

													<?php if (!empty($this->emails) && is_array($this->emails)) : ?>

														<?php foreach ($this->emails as $email) : ?>

															<li class="menu__sub-item">

																<a href="mailto:<?= $email['name'] ?>" target="_blank" class="menu__sub-link"><?= $email['name'] ?></a>

															</li>

														<?php endforeach; ?>

													<?php endif; ?>

												</ul>

											</li>

										<?php endif; ?>

										<?php if (!empty($this->menu['information'])) : ?>

											<?php foreach ($this->menu['information'] as $item) : ?>

												<li class=" menu__item">

													<a href="<?= $this->alias(['information' => $item['alias']]) ?>" class="menu__link"><?= $item['name'] ?></a>

												</li>

											<?php endforeach; ?>

										<?php endif; ?>

										<li class="menu__item"><a href="<?= $this->alias('contacts') ?>" class="menu__link">Контакты</a></li>

									</ul>
								</nav>
							</div>
						</div>

						<div class="header__search">
							<div class="search-form" id="searchButton">
								<button type="button" class="search-form__icon _icon-search"></button>
								<form action="#" class="search-form__item">
									<button class="search-form__btn _icon-search"></button>
									<input autocomplete="off" type="text" name="search" placeholder="найти..." class="search-form__input">
									<input type="hidden" name="search_table" value="goods">
									<div class="dropdown-content search_res">
										<!-- <a href="#">Ссылка 1</a>
										<a href="#">Ссылка 2</a>
										<a href="#">Ссылка 3</a> -->
									</div>
								</form>
							</div>
						</div>

						<button type="button" class="icon-menu">
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>
				</div>
			</div>
		</header>
		<main class="page">