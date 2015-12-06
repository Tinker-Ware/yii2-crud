<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'yii2-crud-demo',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'qmai9mURWrsIvC6Ydf-1xNcOoJJBuBV8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'controllerMap' => [
        [
            'category' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Category::className(),
            ],
            'customer' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Customer::className(),
            ],
            'employee' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Employee::className(),
            ],
            'order' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Order::className(),
            ],
            'product' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Product::className(),
            ],
            'region' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Region::className(),
            ],
            'shipper' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Shipper::className(),
            ],
            'supplier' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Supplier::className(),
            ],
            'terittory' => [
                'class' => \netis\crud\crud\ActiveController::className(),
                'modelClass' => \app\models\Terittory::className(),
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'netisModel' => [
                'class' => 'netis\crud\generators\model\Generator',
            ]
        ],
    ];
}

return $config;
