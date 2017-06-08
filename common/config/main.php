<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],        
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',                
            ]
        ],
        'minifyManager' => [
            'class' => 'maybeworks\minify\MinifyManager',
            'html' => true,
            'css' => true,
            'js' => true,
        ]
    ],
    'timeZone' => 'Asia/Kolkata',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'mailer' => [
                'welcomeSubject'        => 'Welcome To Highcourt Bar Association',
                'NewPasswordSubject'    => 'Highcourt Bar Association Password Changed',
                //'confirmationSubject'   => 'Confirmation subject',
                //'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Highcourt Bar Association Password Recovery',
            ],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],    
];
