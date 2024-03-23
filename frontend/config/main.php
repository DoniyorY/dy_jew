<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'language'=>'ru',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'=>'',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
               /* ''=>'site/index',
                'warehouse'=>'warehouse/index',
                'income'=>'income/index',
                'income/<id>'=>'income/view',
                'request'=>'s-request/index',
                'request/<id>'=>'s-request/view',
                'new-sale'=>'sale/create',
                'sales'=>'sale/index',
                'sale/<id>'=>'sale-view',
                'payment'=>'payment/index',
                'new-client'=>'client/create',
                'client'=>'client/index',
                'client/<id>'=>'client/view',
                'client/update/<id>'=>'client/update',
                'products'=>'products/index',
                'users'=>'user/index',
                'user/<id>'=>'user/view',*/
            ],
        ],

    ],
    'params' => $params,
];
