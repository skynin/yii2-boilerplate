<?php

namespace common\models;

use Yii;
use yii\helpers\Json;

/**
 *
 * @author Skynin <sohay_ua@yahoo.com>
 * created: 01-May-2018
 */
trait ExtInfoTrait
{
	function joSet($nameField, $valueField)
	{
		$tArr = $this->ext_info ?? [];

		if (empty($valueField) && !is_bool($valueField) && !is_numeric($valueField)) {
			unset ( $tArr[$nameField] );
		}
		else
			$tArr[$nameField] = $valueField;

		$this->ext_info = empty($tArr) ? null : $tArr;

		return $this;
	}
	function joUnset($nameField) {
		return $this->joSet($nameField, null);
	}
	function joGet($nameField)
	{
		if ( is_string($this->ext_info))
			$tArr = Json::decode ( $this->ext_info );
		else
			$tArr = $this->ext_info ?? [];
		return $tArr[$nameField] ?? null;
	}

	function joString() : string
	{
		if (empty($this->ext_info)) return '';
		return is_array($this->ext_info) ? Json::encode($this->ext_info) : $this->ext_info;
	}
}
