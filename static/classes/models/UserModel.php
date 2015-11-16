<?php

/**
 * Created by PhpStorm.
 * User: MADinow512
 * Date: 16.11.2015
 * Time: 12:03
 * @property  password
 */
class UserModel extends DatabaseModel
{

    protected static $tablename = 'users' ;

    /**
     * @return UserModel
     *
     */
    public static function getUserByID($id){
        return array_pop(self::getDbAdapter()->exec("SELECT * FROM ".self::$tablename." WHERE id = ?", array($id), get_class()));
    }

    /**
     * @return UserModel
     */
    public static function getUserByName($username){
        return array_pop(self::getDbAdapter()->exec("SELECT * FROM ".self::$tablename." WHERE username = ?", array($username), get_class()));
    }

    /**
     *  @return Boolean
     */
    public static function userExists($username){
        $user = self::getUserByName($username) ;
        return $user !== null;
    }

    /**
     * @return String
     */
    public function getUsername(){
        return $this->username ;
    }

    /**
     * @param $username
     */
    public function setUsername($username){
        $this->username = $username ;
    }

    /**
     * @return String
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     * @return Integer
     */
    public function getID(){
        return $this->id ;
    }

    /**
     * @return String
     */
    public function __toString(){
        return "This is user ".$this->getUsername()." with password ".$this->getPassword()." | id: ".$this->getID();
    }

}