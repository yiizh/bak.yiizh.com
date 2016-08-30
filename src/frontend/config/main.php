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

$config = [
    'id' => APP_FRONTEND,
    'name' => '易',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/<controller:[\w-]+>' => '/<controller>/index',
                '/<controller:[\w-]+>/<id:\d+>' => '/<controller>/view',
                '/<controller:[\w-]+>/<action:[\w-]+>' => '/<controller>/<action>',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl' => ['/login/index'],
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '527273ddaa3adfc847bc500f59024e84',
        ],
    ],
    'params' => $params,
];
if (YII_ENV == 'dev') {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => [
            '*',
        ]
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => [
            '*',
        ],
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [
                    'yiizh' => '@common/gii/model',
                ]
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'yiizh' => '@common/gii/crud',
                ]
            ],
            'controller' => [
                'class' => 'yii\gii\generators\controller\Generator',
                'templates' => [
                    'yiizh' => '@common/gii/controller',
                ]
            ],
            'form' => [
                'class' => 'yii\gii\generators\form\Generator',
                'templates' => [
                    'yiizh' => '@common/gii/form',
                ]
            ],
            'module' => [
                'class' => 'yii\gii\generators\module\Generator',
                'templates' => [
                    'yiizh' => '@common/gii/module',
                ]
            ],
            'extension' => [
                'class' => 'yii\gii\generators\extension\Generator',
                'templates' => [
                    'yiizh' => '@common/gii/extension',
                ]
            ],
        ]
    ];
}

return $config;
