<?php

namespace common\components\snldbextra;

use Yii;

/**
 * Description of SnlConnection
 *
 * @author Skynin <sohay_ua@yahoo.com>
 */
class Connection extends \yii\db\Connection
{
    public function init(  )
    {
        parent::init();

        $this->schemaMap['mysqli'] = 'common\components\snldbextra\Schema';
        $this->schemaMap['mysql'] = 'common\components\snldbextra\Schema';
    }

	public function getSchemaName() {
		if (preg_match('/dbname=([^;]*);?/', $this->dsn, $matches)) {
			return $matches[1];
		}

		return '';
	}
}
