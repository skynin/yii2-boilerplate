<?php

namespace common\components\snldbextra;

use Yii;

/**
 * Description of QueryBuilder
 *
 * @author Skynin <sohay_ua@yahoo.com>
 */
class QueryBuilder extends \yii\db\mysql\QueryBuilder
{
	const LOCK_UPDATE_PARAM = '!lockMode';

	/**
	 * @see LockInShareUpdateTrait
	 * @param \yii\db\Query $query
	 * @param array $params
	 * @return array
	 */
    public function build( $query, $params = [] )
    {
        $lockMode = null;

        if (isset($query->params[self::LOCK_UPDATE_PARAM])) {
			$lockMode = $query->params[self::LOCK_UPDATE_PARAM];
			unset($query->params[self::LOCK_UPDATE_PARAM]);
        }

        $result = parent::build($query, $params);

        if (!empty($lockMode)) {
            list($sql, $params) = $result;

            $sql .= ' ' . $lockMode;

            $result = [$sql, $params];
        }

        return $result;
    }
}
