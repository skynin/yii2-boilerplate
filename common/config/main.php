<?php

defined('APP_VERSION') || define('APP_VERSION', (defined('YII_DEBUG') && YII_DEBUG) ? dechex(rand(1,999999)) : '0.1');

return [
	'version' => APP_VERSION,
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'db' => [
            //'class' => 'yii\db\Connection',
            'class' => 'common\components\snldbextra\Connection',
            'charset' => 'utf8',
			// 'tablePrefix' => 'sn_',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
