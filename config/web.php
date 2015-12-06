<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'yii2-crud-demo',
    'name' => 'Yii2 CRUD demo',
    'aliases' => [
        '@nineinchnick/usr' => '@vendor/nineinchnick/yii2-usr',
        '@netis/crud' => '@vendor/netis/yii2-crud',
        '@netis' => '@vendor/netis',
    ],
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
        'response' => [
            'formatters' => [
                'csv' => 'netis\crud\web\CsvResponseFormatter',
                'pdf' => 'netis\crud\web\PdfResponseFormatter',
                'xls' => 'netis\crud\web\XlsResponseFormatter',
            ],
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
        'formatter' => [
            'class'      => 'netis\crud\web\Formatter',
            'dateFormat' => 'dd-MM-yyyy',
            'datetimeFormat' => 'dd-MM-yyyy HH:mm:ss',
            'nullDisplay' => '',
            'currencyFormat' => '{value}&nbsp;{currency}',
            'thousandSeparator' => ' ',
        ],
        'crudModelsMap' => [
            'class' => 'netis\crud\crud\ModelsMap',
            'data' => [
                'app\models\User' => '/user',
                'app\models\Category' => '/category',
                'app\models\Customer' => '/customer',
                'app\models\CustomerDemographic' => '/customer-demographic',
                'app\models\Employee' => '/employee',
                'app\models\Order' => '/order',
                'app\models\OrderDetail' => '/order-detail',
                'app\models\Product' => '/product',
                'app\models\Region' => '/region',
                'app\models\Shipper' => '/shipper',
                'app\models\Supplier' => '/supplier',
                'app\models\Territory' => '/territory',
            ],
        ],
        'view' => [
            'class' => 'netis\crud\web\View',
            'defaultPath' => [
                //"@app/themes/some-theme/defaultViews",
                '@netis/crud/defaultViews',
            ],
        ],
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
        'customer-demographic' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\CustomerDemographic',
            'searchModelClass' => 'app\models\search\CustomerDemographic',
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
        'order-detail' => [
            'class' => \netis\crud\crud\ActiveController::className(),
            'modelClass' => 'app\models\OrderDetail',
            'searchModelClass' => 'app\models\search\OrderDetail',
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
