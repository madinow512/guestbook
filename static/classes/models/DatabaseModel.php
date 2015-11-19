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
     * @return Integer
     */
    public function getID(){
        return $this->id ;
    }

    /**
     * saves a new model to the database
     */
    public function save(){
        $clazz = $this->getClass();
        $properties = $this->getProperties();
        $nameArr = implode(',', $properties['names']);
        $placeholderArr = implode(',', $properties['placeholders']);
        $query = "INSERT INTO ".$clazz::$tablename." (".$nameArr.") VALUES (".$placeholderArr.")" ;
        self::getDbAdapter()->exec($query, $properties['values'], $clazz);
        return true ;
    }

    /**
     * updates an existing model
     */
    public function update(){
        $clazz = $this->getClass();
        $properties = $this->getProperties();
        $q_set = "SET ";
        for($i = 0; $i < sizeof($properties['names']); $i++){
            $q_set .= $properties['names'][$i]."=".$properties['placeholders'][$i];
            if($i < sizeof($properties['names'])-1){
                $q_set .= ', ' ;
            }
        }
        $query = "UPDATE ".$clazz::$tablename." ".$q_set." WHERE id=".$this->getID();
        self::getDbAdapter()->exec($query, $properties['values'], $clazz);
        return true ;
    }

    /**
     * @return array
     */
    private function getProperties(){
        $reflect = new ReflectionObject($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $tNames = array();
        $tValues = array();
        $tValuePlaceholder = array();
        foreach($props as $prop){
            $prop->setAccessible(true);
            if(!$prop->isStatic() && $prop->getName() !== 'id' && (!preg_match('/_/', $prop->getName()) || strpos($prop->getName(), '_') > 0)) {
                array_push($tNames,  $prop->getName());
                array_push($tValues, $prop->getValue($this));
                array_push($tValuePlaceholder, '?');
            }
        }
        return array("names" => $tNames, "values" => $tValues, "placeholders" => $tValuePlaceholder);
    }

    /**
     * returns the class
     */
    public function getClass(){
        return  get_called_class();
    }

}
