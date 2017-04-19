<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'timeZone' => 'Asia/Kolkata',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin']
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
];
