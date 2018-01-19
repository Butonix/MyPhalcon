<?php
use Phalcon\Di\FactoryDefault;

/*
 * 设置环境变量
 */

define('ENVIRONMENT', isset($_SERVER['Phalcon_ENV']) ? $_SERVER['Phalcon_ENV'] :'development');

switch(ENVIRONMENT){
    case 'development':   //开发环境
        error_reporting('-1');
        ini_set('display_errors',1);
        break;
    case 'testing':     //测试环境
        error_reporting('-1');
        ini_set('display_errors',1);
        break;
    case 'production': //生产环境
        ini_set('display_errors',0);
        if (version_compare(PHP_VERSION,'5.3','>=')){
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATE);
        }else{
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
    default:    //默认请求头跳转 503
        header('\'HTTP/1.1 503 Service Unavailable.\', TRUE, 503');
        echo 'The application environment is not set correctly.';
        exit(1);
}

error_reporting(E_ALL);
//定义根目录和项目路径
define('BASE_PATH',dirname(__DIR__));
define('APP_PATH',BASE_PATH.'/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * 引入服务
     */
    include APP_PATH . '/config/service.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * 引入自动加载
     */
    include APP_PATH . '/config/loader.php';

    /**
     * 处理请求
     */
    $application = new \Phalcon\Mvc\Application($di);

    /**
     * 加入模块配置
     */
    include APP_PATH . '/config/module.php';

    /**
     * 处理路由
     */
    include APP_PATH . '/config/router.php';

    /**
     * 引用自定义公共方法
     */
    include APP_PATH . '/helper/common.php';

    /**
     * 引入composer自动加载类
     */
    include BASE_PATH . "/vendor/autoload.php";

    echo str_replace(["\n", "\r", "\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    //显示异常
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}