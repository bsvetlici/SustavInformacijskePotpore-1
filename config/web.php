<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
  'id' => 'basic',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'modules' => [
    'v1' => [
      'class' => 'app\modules\v1\module'
    ]
  ],
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
  ],
  'components' => [
    'assetManager' => [
      'bundles' => [
        'dosamigos\google\maps\MapAsset' => [
          'options' => [
            'key' => 'AIzaSyCpamZCkQB00zlTGj6xGUFk7sBhUd-kqA0',
            'language' => Yii::$app->language,
            'version' => '3.1.18'
          ]
        ]
      ]
    ],
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'jw3Clr0lu_3dxMKccXyz96TkcOl-oWbb',
      'parsers' => [
        'application/json' => 'yii\web\JsonParser',
      ]
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'user' => [
      'identityClass' => 'app\models\Korisnik',
      'enableAutoLogin' => true,
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
    'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
      // send all mails to a file by default. You have to set
      // 'useFileTransport' to false and configure a transport
      // for the mailer to send real emails.
      'useFileTransport' => false,
      'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com',
        'username' => 'programsko2019@gmail.com',
        'password' => 'Programsko123',
        'port' => '465',
        'encryption' => 'ssl',
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
        ['class' => 'yii\rest\UrlRule',
          'controller' => [
            'v1/korisnik',
            'v1/novosti',
            'v1/prijava',
            'v1/stanje-terena',
            'v1/auth'
          ],
          'pluralize' => false
        ],
        ['class' => 'yii\rest\UrlRule',
          'controller' => [
            'v1/'
          ],
          'patterns' => [
            'POST' => 'create'
          ]
        ]
      ],
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
    //'allowedIPs' => ['127.0.0.1', '::1', '*'],
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1', '*'],
  ];
}

return $config;
