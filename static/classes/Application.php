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
        self::registerClassesAutoloader();
        $model = UserModel::getUserByID();
        die($model);
    }

    private static function registerClassesAutoloader()
    {
        spl_autoload_register(function ($clazz) {
            $classPath = 'static/classes/' . $clazz . '.php';
            if (file_exists($classPath)) {
                include_once $classPath;
                if (method_exists($clazz, 'init')) {
                    $clazz::init();
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