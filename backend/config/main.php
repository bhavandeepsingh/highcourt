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
    'bootstrap' => ['log','assetsAutoCompress'],
    'modules' => [
        'user' => [
            'as backend' => [
                'class' => 'dektrium\user\filters\BackendFilter',
                'controllers' => ['profile', 'recovery', 'registration', 'settings'],
            ],
        ],
    ],
    'components' => [
        'assetsAutoCompress' =>
        [
            'class'                         => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled'                       => true,
            
            'readFileTimeout'               => 3,           //Time in seconds for reading each asset file
            
            'jsCompress'                    => true,        //Enable minification js in html code
            'jsCompressFlaggedComments'     => true,        //Cut comments during processing js
            
            'cssCompress'                   => true,        //Enable minification css in html code
            
            'cssFileCompile'                => true,        //Turning association css files
            'cssFileRemouteCompile'         => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
            'cssFileCompress'               => true,        //Enable compression and processing before being stored in the css file
            'cssFileBottom'                 => false,       //Moving down the page css files
            'cssFileBottomLoadOnJs'         => false,       //Transfer css file down the page and uploading them using js
            
            'jsFileCompile'                 => true,        //Turning association js files
            'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js
            
            'htmlCompress'                  => true,        //Enable compression html
            'noIncludeJsFilesOnPjax'        => true,        //Do not connect the js files when all pjax requests
            'htmlCompressOptions'           =>              //options for compressing output result
            [
                'extra' => false,        //use more compact algorithm
                'no-comments' => true   //cut all the html comments
            ],     
        ],
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
            'controllerMap' => [
                'admin' => 'app\controllers\user\AdminController'
            ],
            'enableRegistration' => false,
            'enableConfirmation' => true,
        ],
    ],
    'params' => $params,
];

