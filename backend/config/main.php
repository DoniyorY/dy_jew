<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'name' => 'CRM JEW',
    'language' => 'ru',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'warehouse' => 'warehouse/index',
                'income' => 'income/index',
                'income/<id>' => 'income/view',
                'new-income' => 'income/create',
                'income/status/<id>&<status>' => 'income/status',
                'income/delete/<id>' => 'income/delete',
                'request' => 's-request/index',
                'request/<id>' => 's-request/view',
                'request/status/<id>&<status>' => 's-request/status',
                'r-items' => 's-request/index-items',
                'sales' => 'sale/index',
                'sale/<id>' => 'sale/view',
                'new-sale' => 'sale/create',
                'client' => 'client/index',
                'client/<id>' => 'client/view',
                'products' => 'products/index',
                'gold-type' => 'gold-type/index',
                'rate' => 'currency-rate/index',
                'user' => 'user/index'
            ],
        ],

    ],
    'params' => $params,
];
