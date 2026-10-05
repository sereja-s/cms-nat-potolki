<?php

namespace core\user\controller;

use core\base\exceptions\RouteException;

/** 
 * Каталог-контроллер пользовательской части (Выпуск №129)
 * 
 * Методы: protected function createCatalogOrder(); protected function checkFilters(); protected function setFilters();
 *         protected function crossDiffArr();
 */
class CatalogController extends BaseUser
{
	protected function inputData()
	{
		parent::inputData();

		// (-Выпуск №131)
		/* $order = [
			'price' => 'цене',
			'name' => 'названию'
		]; */

		// +Выпуск №134
		// количество товаров для отображения на странице каталога
		$quantities = [4, 8, 12, 16];

		// Сформируем название для страницы каталог, взависимости от того в какой категории находимся
		$data = [];

		if (!empty($this->parameters['alias'])) {

			$data = $this->model->get('catalog', [
				'where' => ['alias' => $this->parameters['alias'], 'visible' => 1],
				//'limit' => 1,
				'join' => [
					'goods_catalog' => [
						'fields' => ['goods_id'],
						'on' => ['id', 'catalog_id']
					]
				],
				//'join_structure' => true
			]);

			/* здесь была ошибка -> вместо точки (конкатенации) стояла запятая и передавался второй аргумент в функцию RouteException() - $code = $this->parameters['alias'], хотя должен быть только первый параметр, а второй не передаётся и по умолчанию $code = 0 */
			if (!$data) {
				throw new RouteException('Не найдены записи в таблице catalog по ссылке ' . $this->parameters['alias']);
			}
		}

		// сформируем инструкцию для товаров
		$where['visible'] = 1;

		// Операнд для фильтрации товаров по категории.
		// По умолчанию не используется.
		/* $goodsOperand = null;

		if (!empty($data) && is_array($data)) {
			if (count($data) >= 2) {
				foreach ($data as $item) {
					$where['id'][] = $this->clearNum($item['goods_id']);
				}

				// Безопасное копирование полей с проверкой существования ключей
				$firstItem = $data[0];
				$data['name'] = $firstItem['name'] ?? '';
				$data['keywords'] = $firstItem['keywords'] ?? '';
				$data['content'] = $firstItem['content'] ?? '';
				$data['short_content'] = $firstItem['short_content'] ?? '';
				$data['img'] = $firstItem['img'] ?? '';
				$data['main_img'] = $firstItem['main_img'] ?? '';

				$where['id'] = implode(',', $where['id']);
				$goodsOperand = 'IN';
			} else {
				$data = $data[0];

				// Проверка наличия обязательных ключей в одиночном элементе
				$data['name'] = $data['name'] ?? '';
				$where['id'] = $data['goods_id'] ?? '';
				$goodsOperand = '=';
			}
		} */

		$goodsOperand = null;

		if (!empty($data) && is_array($data)) {

			if (count($data) > 1) {

				foreach ($data as $item) {
					$where['id'][] = $this->clearNum($item['goods_id']);
				}

				$firstItem = $data[0];

				$data = [
					'name'          => $firstItem['name'] ?? '',
					'keywords'      => $firstItem['keywords'] ?? '',
					'content'       => $firstItem['content'] ?? '',
					'short_content' => $firstItem['short_content'] ?? '',
					'img'           => $firstItem['img'] ?? '',
					'main_img'      => $firstItem['main_img'] ?? '',
				];

				$where['id'] = implode(',', $where['id']);

				$goodsOperand = 'IN';
			} else {

				$data = $data[0] ?? [];

				$where['id'] = $data['goods_id'] ?? '';

				$goodsOperand = '=';
			}
		}


		if (!$data) {
			$data['name'] = $this->set['meta_title'];
		}

		// +Выпуск №131
		$catalogFilters = $catalogPrices = $orderDb = null;

		// Выпуск №131
		// здесь формируем сортировку для пользовательского шаблона
		$order = $this->createCatalogOrder($orderDb);

		// Выпуск №132
		$operand = $this->checkFilters($where);

		/* if ($data['name'] !== 'Каталог') {
			array_push($operand, $goodsOperand);
		} */

		if (
			($data['name'] ?? '') !== 'Каталог' &&
			$goodsOperand !== null
		) {
			$operand[] = $goodsOperand;
		}

		// Получим товары (с их фильтрами и ценами):

		$goods = $this->model->getGoods([
			'where' => $where,
			// +Выпуск №132
			'operand' => $operand,
			// +Выпуск №131
			'order' => $orderDb['order'],
			'order_direction' => $orderDb['order_direction'],
			// +Выпуск №135
			'pagination' => [
				'qty' => $_SESSION['quantities'] ?? QTY,

				'page' => $this->clearNum($_GET['page'] ?? 1) ?: 1
			]
		], $catalogFilters, $catalogPrices);

		$page = $_GET['page'] ?? '';

		// Выпуск №136
		// сохраним результат работы метода (формирует и возвращает массив с постраничной навигацией) в BaseModelMethods.php
		$pages = $this->model->getPagination();

		return compact('data', 'catalogFilters', 'catalogPrices', 'goods', 'order', 'quantities', 'pages', 'page');
	}


	/** 
	 * Метод сортировки каталога товаров (В каталоге реализуем- сортировать по:) (Выпуск №131)
	 * (также формирует сортировку для БД, поэтому на вход принимает по ссылке переменную для сортировки в БД) 
	 */
	protected function createCatalogOrder(&$orderDb)
	{
		$order = [

			'цене' => 'price_asc',

			'названию' => 'name_desc'

		];

		// изначально инициализируем массив
		$orderDb = ['order' => null, 'order_direction' => null];

		// если в сортировщик что то пришло
		if (!empty($_GET['order'])) {

			// preg_split — Разбивает строку по регулярному выражению
			$orderArr = preg_split('/_+/', $_GET['order'], 0, PREG_SPLIT_NO_EMPTY);

			if (empty($orderArr[0])) {
				return $order;
			}

			if (!empty($this->model->showColumns('goods')[$orderArr[0]])) {

				$orderDb['order'] = $orderArr[0];

				$orderDb['order_direction'] = $orderArr[1] ?? null;

				// здесь надо понять какая сортировка сейчас выбрана пользователем
				foreach ($order as $key => $item) {

					// strpos — Ищет позицию первого вхождения подстроки needle в строку haystack.
					if (strpos($item, $orderDb['order']) === 0) {

						$direction = $orderDb['order_direction'] === 'asc' ? 'desc' : 'asc';

						$order[$key] = $orderDb['order'] . '_' . $direction;

						break;
					}
				}
			}
		}

		return $order;
	}

	/** 
	 * Метод фильтрации каталога (Выпуск №132)
	 */
	protected function checkFilters(&$where)
	{
		// переменная при помощи которой будем модифицировать $where
		$dbWhere = [];

		// массив, который будем возвращать из этого метода (готовим для БД)
		$dbOperand = [];

		if (isset($_GET['min_price'])) {

			$dbWhere['price'] = $this->clearNum($_GET['min_price']);

			$dbOperand[] = '>=';
		}

		if (isset($_GET['max_price'])) {

			// здесь ячейка: [' price'] названа с побелом в начале, что бы не переопределилась одноимённая ячейка выше
			$dbWhere[' price'] = $this->clearNum($_GET['max_price']);

			$dbOperand[] = '<=';
		}


		// +Выпуск №133 Пользовательская часть | система перекрестных фильтров
		if (!empty($_GET['filters']) && is_array($_GET['filters'])) {

			// получим подзапрос в котором id значений разных фильтров выбранных пользователем, сгруппированы в перекрёстном виде
			$subFiltersQuery = $this->setFilters();

			if ($subFiltersQuery) {

				$dbWhere['id'] = $subFiltersQuery;

				$dbOperand[] = 'IN';
			}


			// -Выпуск №133
			/* $dbWhere['id'] = $this->model->get('goods_filters', [
				'fields' => ['goods_id'],
				'where' => ['filters_id' => implode(',', $_GET['filters'])],
				'operand' => ['IN'],
				'return_query' => true // что бы вернулся запрос
			]); */
		}

		//$where = array_merge($dbWhere, $where);

		$where = array_merge($dbWhere, $where ?? []);

		$dbOperand[] = '=';

		return $dbOperand;
	}

	/** 	
	 * Метод получает значения фильтров (их сочетания) Выпуск №133- Пользовательская часть | система перекрестных фильтров
	 */
	protected function setFilters()
	{
		if (empty($_GET['filters']) || !is_array($_GET['filters'])) {
			return '';
		}

		foreach ($_GET['filters'] as $key => $item) {

			$_GET['filters'][$key] = $this->clearNum($item);

			if (!$_GET['filters'][$key]) {

				unset($_GET['filters'][$key]);

				continue;
			}

			// поищем дубликаты (что бы снять нагрузку с БД)
			$other = array_search($_GET['filters'][$key], $_GET['filters']);

			if ($other !== false && $other !== $key)
				unset($_GET['filters'][$key]);
		}

		if (empty($_GET['filters'])) {
			return '';
		}

		// получим фильтры с привязкой к родителям
		$res = $this->model->get('filters', [
			'where' => ['id' => 'SELECT DISTINCT parent_id FROM filters WHERE id IN(' . implode(',', $_GET['filters']) . ')'],
			'operand' => ['IN'],
			'join' => [
				// соединяемся этой же таблицей (здесь- filters), но применим псевдоним: f_val (здесь нужны значения)
				'filters f_val' => [
					'where' => ['id' => implode(',', $_GET['filters'])],
					'operand' => ['IN'],
					'fields' => ['id'],
					// укажем по какому критерию: id из предыдущей таблицы (здесь- filters) смотрит на parent_id из текущей 
					// (здесь таже ,но с псевдонимом: filters f_val)
					'on' => ['id', 'parent_id']
				]
			],
			'join_structure' => true
			//'return_query' => true
		]);


		// По условию соберём массив массивов (реализуем систему перекрестных фильтров): 
		if ($res) {

			$arr = [];

			$c = 0;

			foreach ($res as $item) {

				if (isset($item['join']['f_val'])) {

					// получим массивы в которых будут разложены id значений, которые были отмечены пользователем (для 
					// каждого фильтра, содеращего выбранный значения)
					$arr[$c] = array_column($item['join']['f_val'], 'id');

					$c++;
				}
			}

			// найдём перекрёсные сочетания значений от разных фильтров в полученном массиве
			$resArr = $this->crossDiffArr($arr);

			// разберём полученный массив
			if ($resArr) {

				$queryStr = '';

				// нужна переменная, т.к. будет применяться инструкция группировки: GROUP с инструкцией: HAVING
				// (изначально инициализируем её нулём)
				$filtersCount = 0;

				foreach ($resArr as $key => $item) {

					!$filtersCount && $filtersCount = count($item);

					$queryStr .= ' filters_id IN(' . implode(',', $item) . ')' . (isset($resArr[$key + 1]) ? ' OR ' : '');
				}

				return 'SELECT goods_id FROM goods_filters WHERE ' . $queryStr . ' GROUP BY goods_id HAVING COUNT(goods_id) >= '  . $filtersCount;
			}
		}

		return '';
	}

	/** 
	 * Метод получает перекрёсные сочетания значений от разных фильтров, которые отметил и применил пользователь в каталоге (Выпуск №133)
	 * На вход: 1-массив, 2-счётчик, исходя из которого будем забираться вверх
	 */
	protected function crossDiffArr($arr, $counter = 0)
	{
		if (empty($arr)) {
			return [];
		}
		// если в массиве массивов пришёл только один элемент(массив)
		if (count($arr) === 1) {

			// разделим этот массив, по-элементно и вернём эти элементы в отдельных массивах каждый
			return array_chunk(array_shift($arr), 1);
		}

		// проверим добрались ли мы до самого первого элемента (шли с конца массива)
		if ($counter === count($arr) - 1)
			return $arr[$counter];

		// Вызовем рекурсивно этот же метод (он будет проходить и буферизовать все данные и от последнего к первому их возвращать)
		$buffer = $this->crossDiffArr($arr, $counter + 1);

		$res = [];

		foreach ($arr[$counter] as $a) {

			foreach ($buffer as $b) {

				$res[] = is_array($b) ? array_merge([$a], $b) : [$a, $b];
			}
		}

		return $res;
	}
}
