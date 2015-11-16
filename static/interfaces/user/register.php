<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 18:56
 */
require_once '../../initApplication.php' ;

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['c_password'])){

    $username = $_POST['username'] ;
    $password = $_POST['password'] ;
    $c_password = $_POST['c_password'] ;

    if(!UserModel::userExists($username)){
        if($password === $c_password){
            $password = PassHash::hash($password);
            $model = new UserModel();
            $model->setUsername($username);
            $model->setPassword($password);
            $model->save();
            Core::sendHTTPResponse(200, "Du hast Dich erfolgreich registriert.");
        }else{
            Core::sendHTTPResponse(400, "Deine Passworteingaben stimmen nicht überein.");
        }
    }else{
        Core::sendHTTPResponse(400, "Es existiert bereits ein Benutzer mit diesem Namen.") ;
    }

}else{
    Core::sendHTTPResponse(400, "Bitte fülle alle Felder aus.") ;
}
