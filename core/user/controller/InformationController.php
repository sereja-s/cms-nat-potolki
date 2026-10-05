<?php

namespace core\user\controller;

use core\admin\model\Model;
use core\base\controller\BaseController;


class InformationController extends BaseUser
{
	protected function inputData()
	{
		parent::inputData();

		$infoData = [];

		if (!empty($this->menu['information-bottom'])) {

			foreach ($this->menu['information-bottom'] as $item) {

				if (
					isset($this->parameters['alias']) &&
					$item['alias'] === $this->parameters['alias']
				) {

					$infoData = [
						'name' => $item['name'],
						'content' => $item['content']
					];

					break;
				}
			}
		}

		return compact('infoData');
	}
}
