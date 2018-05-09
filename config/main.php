<?php

define("PUBLIC_DIR", ROOT_DIR . "/public");
define("PICS_DIR", ROOT_DIR . "/public/img");
define("TUMBS_DIR", ROOT_DIR . "/public/img/tumbs");
define("UPLOADS_DIR", ROOT_DIR . "/uploads");
define("PICS_DIR", ROOT_DIR . "/");
define("DEFAULT_CONTROLLER", 'product');

return [
    'root_dir' => __DIR__ . "/../",
    'templates_dir' => __DIR__ . "/../views",
    'twig_cache_dir' => __DIR__ . "/views/compilation_cache",
    'controllers_namespaces' => 'app\controllers\\',
    'repositories_namespaces' => 'app\models\repositories\\',
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'Megashop',
            'charset' => 'utf8'
        ],
        'db_pgsql' => [
            'class' => \app\services\Db::class,
            'driver' => 'pgsql',
            'host' => '127.0.0.1',
            'login' => 'user',
            'password' => 'password',
            'database' => 'storage',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'session' => [
            'class' => \app\services\Session::class
        ],
        'user' => [
            'class' => \app\models\entities\User::class
        ],
        'order' => [
            'class' => \app\models\entities\Order::class
        ]


    ]

];
