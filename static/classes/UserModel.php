<?php

/**
 * Created by PhpStorm.
 * User: MADinow512
 * Date: 16.11.2015
 * Time: 12:03
 */
class UserModel extends DatabaseModel
{

    /**
     * @return UserModel
     *
     */
    public static function getUserByID(){
        return array_pop(self::getDbAdapter()->exec("SELECT * FROM users WHERE id = ?", array(1), get_class()));
    }

    public function getUsername(){
        return $this->username ;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getID(){
        return $this->id ;
    }

    public function __toString(){
        return "This is user ".$this->getUsername()." with password ".$this->getPassword()." | id: ".$this->getID();
    }

}