<?php

/**
 * Created by PhpStorm.
 * User: MADinow512
 * Date: 16.11.2015
 * Time: 11:05
 */
class Application
{

    /**
     * @var Application
     */
    private static $appInstance;

    /**
     * initializes the application
     */
    public static function init()
    {
        self::$appInstance = new Application();
        self::registerAutoloadForClasses();
    }

    private static function registerAutoloadForClasses()
    {
        spl_autoload_register(function ($clazz) {
            $classPathArr = array('lib', 'models');
            $found = false ;
            foreach($classPathArr as $classPath){
                $path = $_SERVER['DOCUMENT_ROOT'].'/static/classes/'.$classPath.'/'.$clazz.'.php';
                if (file_exists($path)) {
                    include_once $path;
                    if (method_exists($clazz, 'init')) {
                        $clazz::init();
                    }
                    $found = true ;
                    break ;
                }
            }
        });
    }


    /**
     * private constructor due to singleton pattern
     */
    private function __construct()
    {

    }

}