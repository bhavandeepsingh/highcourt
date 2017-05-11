<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [    
            //'class' => 'common\models\User',
            'identityClass' => 'common\models\User',
            'loginUrl' => ['site/login'],
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',
            ]
        ]
    ],
    'timeZone' => 'Asia/Kolkata',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'mailer' => [
                'welcomeSubject'        => 'Welcome to Highcourt Bar Association',
                //'confirmationSubject'   => 'Confirmation subject',
                //'reconfirmationSubject' => 'Email change subject',
                //'recoverySubject'       => 'Recovery subject',
            ],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
];
