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
	function jsonWhere(array $args) : \yii\db\ActiveQueryInterface
	{
		// ext_info->>'$.foo_id' = '123'

		foreach ($args as $key=>$value) {

			$joQue = 'ext_info->>\'$.';
			$joBind = [':joValue' => null];

			if ( is_array($value)) {
				$joQue .= $value[1] . '\' ' . $value[0] . ' ';
				$joBind[':joValue'] = $value[2];
			}
			else {
				$joQue .= $key . '\' = ';
				$joBind[':joValue'] = $value;
			}

			$this->andWhere(new Expression($joQue . ' ' . ':joValue', $joBind));
		}

		return $this;
	}
}
