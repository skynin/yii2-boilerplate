<?php

namespace common\models;

use yii\db\Expression;

/**
 *
 * @author Skynin <sohay_ua@yahoo.com>
 * created: 03-May-2018
 */
trait ExtInfoQueryTrait
{
	function joWhere(array $args) : \yii\db\ActiveQuery
	{
		$joQue = 'ext_info->>\'$.';

		$firstElem = reset($args);
		if (preg_match('/^(<>|>=|>|<=|<|=|is)/i', $firstElem)) {
			$this->andWhere("$joQue$args[1]' $args[0] $args[2]");
		}
		else
		foreach ($args as $key=>$value) {
			$this->andWhere(new Expression($joQue . $key . '\' = ' . ':joValue', [':joValue' => $value]));
		}

		return $this;
	}
}
