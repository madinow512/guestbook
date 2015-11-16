<?php

/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 04.11.2015
 * Time: 12:53
 */
class CustomSessionHandler
{

    private static $simSession = null ;

    public static function init(){
        self::createNewSession();
    }

    public static function createNewSession()
    {
        if (!self::doesSessionExist()) {
            self::$simSession = array();
        }
    }

    public static function doesSessionExist()
    {
        return isset(self::$simSession) ;
    }

    public static function destroySession()
    {
        self::$simSession = null ;
    }

    public static function bindNewSessionParam($key, $value)
    {
        if (isset($key) && isset($value)) {
            self::$simSession[$key] = $value;
        }
    }

    public static function getSessionParamByKey($key)
    {
        if (self::doesSessionParamExist($key)) {
            return self::$simSession[$key];
        }
        return null;
    }

    public static function doesSessionParamExist($key)
    {
        return self::doesSessionExist() && isset($key) && isset(self::$simSession[$key]) ;
    }

}