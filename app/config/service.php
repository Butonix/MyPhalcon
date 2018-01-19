<?php

//引入Phalcon的模块和组件配置
use Phalcon\Mvc\View;    //视图模块
use Phalcon\Mvc\View\Engine\Php as PhpEngine; //php引擎
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;  //volt模板引擎
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Cache\Frontend\Data as FrontendData;
use Phalcon\Cache\Backend\Redis;  //redis


/**
 * 根据变量配置不同数据库配置
 */

$di->setShared('database_config',function() {
    if(ENVIRONMENT == 'development'){

    }else if(ENVIRONMENT == "testing"){

    }else{

    }
});

