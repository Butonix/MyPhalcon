<?php
return [
    //mysql 配置
    'mysql' =>[
        'adapter' =>'Mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'xry',
        'port' => '3306',
        'charset' => 'UTF8'

    ],
    //redis 配置
    'redis' =>[
        'host' =>'127.0.0.1',
        'port' =>'6389',
        'auth' => '',
    ],

    //mogodb 配置

    'mongodb' => [
        'host' =>'127.0.0.1',
        'port' => '',
        'auth' => '',
    ]
];