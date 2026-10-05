<?php

namespace core\user\controller;

use core\admin\model\Model;
use core\base\controller\BaseController;


class ContactsController extends BaseUser
{

	protected function inputData()
	{

		parent::inputData();

		$contacts_page = $this->model->get('contacts_page', [
			'order' => ['id'],
			'limit' => 1
		]);

		$contacts_page && $contacts_page = $contacts_page[0];

		//$data = [];

		$infoData['name'] = $contacts_page['name'];
		//$infoData['title'] = $contacts_page['title'];

		// собираем переменные в массив и возвращаем в шаблон, что бы они стали доступными при выводе
		return compact('contacts_page', 'infoData');
	}
}
