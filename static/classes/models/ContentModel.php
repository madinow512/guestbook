<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 19.11.2015
 * Time: 15:00
 */

class ContentModel extends DatabaseModel{

    /**
     * @var String
     */
    protected static $tablename = 'content';

    /**
     * @return array
     */
    public static function getPublicContent(){
        return self::getDbAdapter()->exec("SELECT * FROM content WHERE user_id IS NULL ORDER BY created DESC", null, get_class());
    }

    /**
     * @return array
     */
    public static function getPrivateContent(){
        return self::getDbAdapter()->exec("SELECT * FROM content WHERE user_id IS NOT NULL ORDER BY created DESC", null, get_class());
    }

    /**
     * @var UserModel
     */
    private $_user ;

    /**
     * @param $username
     */
    public function setUsername($username){
        $this->username = $username ;
    }

    /**
     * @return String
     */
    public function getUsername(){
        return $this->username ;
    }

    /**
     * @param $userID
     */
    public function setUserID($userID){
        $this->user_id = $userID ;
        $this->_user = UserModel::getUserByID($userID);
    }

    /**
     * @return Integer
     */
    public function getUserID(){
        return $this->user_id ;
    }

    /**
     * @return UserModel
     */
    public function getUser(){
        return $this->_user ;
    }

    /**
     * @param $title
     */
    public function setTitle($title){
        $this->title = $title ;
    }

    /**
     * @return String
     */
    public function getTitle(){
        return $this->title ;
    }

    /**
     * @param $message
     */
    public function setMessage($message){
        $this->message = $message ;
    }

    /**
     * @return String
     */
    public function getMessage(){
        return $this->message ;
    }

    /**
     * @return DateTime
     */
    public function getCreationDate(){
        return $this->created ;
    }

}