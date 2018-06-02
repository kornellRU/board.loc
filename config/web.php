<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'ru-RU',
    'sourceLanguage'=>'ru',
    'timezone' => 'Europe/Kiev',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5KLtV96klVU6eiYUDQ-j9UC5L3fo2XKQ',
        ],
        'i18n' => [
            'translations' => [
                'users' =>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@budyaga/users/messages',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'users' => 'users.php'
                    ]
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
//                'vkontakte' => [
//                    'class' => 'budyaga\users\components\oauth\VKontakte',
//                    'clientId' => 'XXX',
//                    'clientSecret' => 'XXX',
//                    'scope' => 'email'
//                ],
//                'google' => [
//                    'class' => 'budyaga\users\components\oauth\Google',
//                    'clientId' => 'XXX',
//                    'clientSecret' => 'XXX',
//                ],
//                'facebook' => [
//                    'class' => 'budyaga\users\components\oauth\Facebook',
//                    'clientId' => 'XXX',
//                    'clientSecret' => 'XXX',
//                ],
//                'github' => [
//                    'class' => 'budyaga\users\components\oauth\GitHub',
//                    'clientId' => 'XXX',
//                    'clientSecret' => 'XXX',
//                    'scope' => 'user:email, user'
//                ],
//                'linkedin' => [
//                    'class' => 'budyaga\users\components\oauth\LinkedIn',
//                    'clientId' => 'XXX',
//                    'clientSecret' => 'XXX',
//                ],
//                'live' => [
//                    'class' => 'budyaga\users\components\oauth\Live',
//                    'clientId' => 'XXX',
//                    'clientSecret' => 'XXX',
//                ],
//                'yandex' => [
//                    'class' => 'budyaga\users\components\oauth\Yandex',
//                    'clientId' => 'XXX',
//                    'clientSecret' => 'XXX',
//                ],
//                'twitter' => [
//                    'class' => 'budyaga\users\components\oauth\Twitter',
//                    'consumerKey' => 'XXX',
//                    'consumerSecret' => 'XXX',
//                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'htmlLayout'=>false,
            'textLayout'=>false,
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'ruslantyulyukinkornell@gmail.com',
                'password' => 'asesivultcopromz',
                'port' => '587',
                'encryption' => 'tls',
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/signup' => '/login/signup',
                '/login' => '/login/login',
                '/logout' => '/login/logout',
                '/requestPasswordReset' => '/login/request-password-reset',
                '/resetPassword' => '/login/reset-password',
                '/profile/<id:\d+>/<name>' => '/profile/default/index',
                '/profile/<id:\d+>' => '/profile/default/index',
                '/profile/review' => '/profile/default/review',
                '/profile' => '/profile/default/index',
                '/profile/setting' => '/profile/default/setting',
                '/retryConfirmEmail' => '/login/retry-confirm-email',
                '/confirmEmail' => '/login/confirm-email',
                '/unbind/<id:[\w\-]+>' => '/user/auth/unbind',
                '/oauth/<authclient:[\w\-]+>' => '/user/auth/index',
                '' => '/ad/index',
                'ad/<id:\d+>/<name>' => '/ad/view',
                'ad/<id:\d+>' => '/ad/view',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

    ],
    'modules' => [
        'user' => [
            'class' => 'budyaga\users\Module',
            'userPhotoUrl' => '/images/users',
            'userPhotoPath' => '@app/web/images/users'
        ],
        'profile' => [
            'class' => 'app\modules\profile\Module',
            'defaultRoute' => 'default/index',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
