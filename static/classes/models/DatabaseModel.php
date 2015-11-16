<?php

/**
 * Created by PhpStorm.
 * User: MADinow512
 * Date: 16.11.2015
 * Time: 10:58
 */
abstract class DatabaseModel
{

    /**
     * @var DatabaseAdapter
     */
    protected static $dbAdapter ;

    /**
     * returns the reference to the static database adapter
     * @return DatabaseAdapter
     */
    static function getDbAdapter(){
        return self::$dbAdapter ;
    }

    static function init(){
        self::$dbAdapter = new DatabaseAdapter();
    }

}