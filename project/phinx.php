<?php
require_once __DIR__.'/app/init/init.php';

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => env('DB_HOST', 'mariadb'),
            'name' => env('DB_NAME', 'project'),
            'user' => env('DB_USERNAME', 'root'),
            'pass' =>  env('DB_PASSWORD', 'secret'),
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => env('DB_HOST', 'mariadb'),
            'name' => env('DB_NAME', 'project'),
            'user' => env('DB_USERNAME', 'root'),
            'pass' =>  env('DB_PASSWORD', 'secret'),
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => env('DB_HOST', 'mariadb'),
            'name' => env('DB_NAME', 'project'),
            'user' => env('DB_USERNAME', 'root'),
            'pass' =>  env('DB_PASSWORD', 'secret'),
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
