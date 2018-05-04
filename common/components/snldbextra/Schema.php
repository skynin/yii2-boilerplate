<?php

namespace common\components\snldbextra;

use Yii;

/**
 * Description of Schema
 *
 * @author Skynin <sohay_ua@yahoo.com>
 */
class Schema extends \yii\db\mysql\Schema
{
    public function createQueryBuilder()
    {
        return new QueryBuilder($this->db);
    }

    protected function getColumnPhpType($column)
    {
       static $alwaysInteger = ['tinyint', 'smallint', 'mediumint'];

	   if ($column->type === 'integer') return 'integer'; // dangerous for 32bit php version

       if ($column->unsigned) {
           foreach ( $alwaysInteger as $fieldType ) {
               if (stripos($column->dbType, $fieldType) !== false) return 'integer';
           }
       }

       return parent::getColumnPhpType($column);
    }
}
