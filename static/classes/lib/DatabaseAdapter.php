<?php

/**
 * Created by PhpStorm.
 * User: MADinow512
 * Date: 16.11.2015
 * Time: 10:57
 */
class DatabaseAdapter
{

    private static $DB_SERVER = 'localhost';
    private static $DB_NAME = 'guestbook';
    private static $DB_USER = 'root';
    private static $DB_PASSWORD = '';

    /**
     * @var PDO
     */
    private $connection ;

    public function __construct(){ }

    private function connect(){
        $this->connection = new PDO("mysql:host=".self::$DB_SERVER.";dbname=".self::$DB_NAME.";charset=utf8", self::$DB_USER, self::$DB_PASSWORD);
    }

    private function disconnect(){
        $this->connection = null ;
    }

    public function exec($query = "", $params = null, $clazz = null){
        if(!isset($params)){
            $params = array();
        }
        $isClazzDefined = isset($clazz);
        $this->connect();
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        $result = array();
        if($isClazzDefined){
            $result = $statement->fetchAll(PDO::FETCH_CLASS, $clazz);
        }else{
            $result = $statement->fetchAll();
        }
        $this->disconnect();
        return $result;
    }

    public function __toString(){
        return "I am a database adapter" ;
    }

}