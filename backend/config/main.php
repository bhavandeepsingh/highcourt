<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'HBA',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'as backend' => [
                'loginUrl' => ['user/security/login'],
                'class' => 'dektrium\user\filters\BackendFilter',
                'controllers' => ['profile', 'recovery', 'registration', 'settings']
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
           'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => 'backend/',
                'httpOnly' => true,
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                    '@dektrium/rbac/views' => '@app/views/rbac'
                ],
            ],
        ],
        'session' => [
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => 'backend/',
            ],
        ],
        /*'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'user' => [
            // following line will restrict access to admin controller from backend application
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'modelMap' => [
                'User'      => 'common\models\User',
                'UserSearch'=> 'common\models\UserSearch',
                'Profile'   => 'common\models\Profile',
            ],
        ],
    ],
    'params' => $params,
];

