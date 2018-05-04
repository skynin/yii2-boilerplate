<?php

namespace common\components\snldbextra;

/**
 * Trait for Query
 *
 * @author Skynin <sohay_ua@yahoo.com>
 */
trait LockInShareUpdateTrait
{
	public function forUpdate() {
       $this->addParams([QueryBuilder::LOCK_UPDATE_PARAM => 'FOR UPDATE']);

       //return Yii::$app->getDb()->getQueryBuilder()->forUpdate();
		// SELECT ... FOR UPDATE
		// TODO https://github.com/yiisoft/yii2/issues/11730
		return $this;
	}
	public function lockInShare() {
       $this->addParams([QueryBuilder::LOCK_UPDATE_PARAM => 'LOCK IN SHARE MODE']);

		// SELECT ... LOCK IN SHARE MODE mysql
		// https://www.postgresql.org/docs/9.0/static/sql-select.html#SQL-FOR-UPDATE-SHARE
		// TODO https://github.com/yiisoft/yii2/issues/11730
		return $this;
	}
}
