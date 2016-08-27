<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => APP_CONSOLE,
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'templateFile' => '@console/views/migration.php',
            'generatorTemplateFiles' => [
                'create_table' => '@yii/views/createTableMigration.php',
                'drop_table' => '@yii/views/dropTableMigration.php',
                'add_column' => '@yii/views/addColumnMigration.php',
                'drop_column' => '@yii/views/dropColumnMigration.php',
                'create_junction' => '@yii/views/createTableMigration.php',
            ]
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];