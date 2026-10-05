<?php

namespace core\user\controller;

/** 
 * Индексный контроллер пользовательской части
 */
class IndexController extends BaseUser
{
	protected $name;

	protected function inputData()
	{
		// Выпуск №120
		parent::inputData();

		// Выпуск №124- Пользовательская часть | вывод акций (слайдер под верхним меню)
		$sales = $this->model->get('sales', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);

		$rooms = $this->model->get('rooms', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);

		$tips = $this->model->get('tips', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);

		// Выпуск №128 - массив преимуществ
		$advantages = $this->model->get('advantages', [
			'where' => ['visible' => 1],
			'order' => ['menu_position'],
			'limit' => 6
		]);

		$questions = $this->model->get('questions', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);

		// Выпуск №128 | Вывод новостей
		/* $news = $this->model->get('news', [
			'where' => ['visible' => 1],
			'order' => ['date'],
			'order_direction' => ['DESC'],
			'limit' => 3
		]); */

		// Выпуск №126
		// массив предложений (главная страница) +Выпуск №127
		$arrHits = [

			'hit' => [
				'name' => 'Хит продаж',
				'icon' => ''
			],
			/* 'hot' => [
				'name' => 'Горячие предложения',
				'icon' => '<svg><use xlink:href="' . PATH . TEMPLATE . 'assets/img/icons.svg#hot"</use></svg>'
			], */
			/* 'sale' => [
				'name' => 'Распродажа',
				'icon' => ''
			], */
			'new' => [
				'name' => 'Наши новинки',
				'icon' => ''
			],

		];

		$goods = [];

		foreach ($arrHits as $type => $item) {

			$goods[$type] = $this->model->getGoods([
				'where' => [$type => 1, 'visible' => 1], // +Выпуск №127
				'order' => ['datetime'],
				'order_direction' => ['DESC'],
				'limit' => 12 // выводим не более 7 товаров у которых включены соответствующие предложения
			]);
		}

		// Выпуск №125
		//$goods = $this->model->getGoods();

		// собираем переменные в массив и возвращаем в шаблон, что бы они стали доступными при выводе
		return compact('sales', 'arrHits', 'goods', 'advantages', 'questions', 'rooms', 'tips');
	}
}
