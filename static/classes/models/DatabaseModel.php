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
     * @var String
     */
    protected static $tablename;

    /**
     * returns the reference to the static database adapter
     * @return DatabaseAdapter
     */
    static function getDbAdapter(){
        return self::$dbAdapter ;
    }

    /**
     * initializes the database model
     */
    static function init(){
        self::$dbAdapter = new DatabaseAdapter();
    }

    /**
     * saves the model to the database
     */
    public function save(){
        $clazz = $this->getClass();
        $reflect = new ReflectionObject($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $tNames = array();
        $tValues = array();
        $tValuePlaceholder = array();
        foreach($props as $prop){
            $prop->setAccessible(true);
            if(!$prop->isStatic()) {
                array_push($tNames,  $prop->getName());
                array_push($tValues, $prop->getValue($this));
                array_push($tValuePlaceholder, '?');
            }
        }
        $nameArr = implode(',', $tNames);
        $placeholderArr = implode(',', $tValuePlaceholder);
        $query = "INSERT INTO ".$clazz::$tablename." (".$nameArr.") VALUES (".$placeholderArr.")" ;
        self::getDbAdapter()->exec($query, $tValues, $clazz);
        return true ;
    }

    /**
     * returns the class
     */
    public function getClass(){
        return  get_called_class();
    }

}
