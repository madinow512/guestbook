<?php

/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 04.11.2015
 * Time: 12:53
 */

define('USER', 'USERNAME');

class CustomSessionHandler
{

    public static function init(){
        self::createNewSession();
    }

    public static function createNewSession()
    {
        if (!self::doesSessionExist()) {
            session_start();
        }
    }

    public static function doesSessionExist()
    {
        return isset($_SESSION) ;
    }

    public static function destroySession()
    {
        session_destroy();
    }

    public static function bindNewSessionParam($key, $value)
    {
        if (isset($key) && isset($value)) {
            $_SESSION[$key] = $value;
        }
    }

    public static function getSessionParamByKey($key)
    {
        if (self::doesSessionParamExist($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function doesSessionParamExist($key)
    {
        return self::doesSessionExist() && isset($key) && isset($_SESSION[$key]) ;
    }

}