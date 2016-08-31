<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\auth\clients\Weibo;

return [
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'vendorPath' => APP_ROOT . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . getenv('MYSQL_HOST') . ';dbname=' . getenv('MYSQL_DB'),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASS'),
            'tablePrefix' => 'tbl_',
            'charset' => 'utf8',
        ],
        'formatter' => [
            'defaultTimeZone' => 'Asia/Shanghai',
            'datetimeFormat' => 'php:Y-m-d H:i',
            'dateFormat' => 'php:Y-m-d',
            'timeFormat' => 'php:H:i:s',
            'nullDisplay' => '无'
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'weibo' => [
                    'class' => Weibo::className(),
                    'title' => '新浪微博',
                    'clientId' => getenv('WEIBO_CLIENT_ID'),
                    'clientSecret' => getenv('WEIBO_CLIENT_SECRET'),
                ],
            ],
        ]
    ],
];