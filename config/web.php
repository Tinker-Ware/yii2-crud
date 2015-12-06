<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'yii2-crud-demo',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'authManager' => [
            'class' => 'netis\rbac\DbManager',
            'cache' => 'cache',
        ],
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
            'loginUrl' => ['usr/login'],
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
        'category' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Category',
            'searchModelClass' => 'app\models\search\Category',
        ],
        'customer' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Customer',
            'searchModelClass' => 'app\models\search\Customer',
        ],
        'employee' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Employee',
            'searchModelClass' => 'app\models\search\Employee',
        ],
        'order' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Order',
            'searchModelClass' => 'app\models\search\Order',
        ],
        'product' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Product',
            'searchModelClass' => 'app\models\search\Product',
        ],
        'region' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Region',
            'searchModelClass' => 'app\models\search\Region',
        ],
        'shipper' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Shipper',
            'searchModelClass' => 'app\models\search\Shipper',
        ],
        'supplier' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Supplier',
            'searchModelClass' => 'app\models\search\Supplier',
        ],
        'terittory' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\Terittory',
            'searchModelClass' => 'app\models\search\Territory',
        ],
    ],
    'modules' => [
        'usr' => [
            'class' => 'nineinchnick\usr\Module',
            'requireVerifiedEmail' => false,
        ],
    ],
    'params' => $params,
];

if (YII_ENV === 'dev') {
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
