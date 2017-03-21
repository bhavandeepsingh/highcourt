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
];
