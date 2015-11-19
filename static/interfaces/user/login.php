<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 17:37
 */

require_once '../../initApplication.php' ;

if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username'] ;
    $password = $_POST['password'] ;

    if(UserModel::userExists($username)){
        $user = UserModel::getUserByName($username) ;
        if(PassHash::check_password($user->getPassword(), $password)){
            $user->setLastLogin(date('Y-m-d G:i:s'));
            $user->update();
            CustomSessionHandler::bindNewSessionParam(USER, $user->getUsername());
            Core::sendHTTPResponse(200, "Willkommen, ".$username.".");
        }else{
            Core::sendHTTPResponse(400, "Bitte gib Dein korrektes Passwort ein.");
        }
    }else{
        Core::sendHTTPResponse(400, "Es existiert kein Benutzer mit diesem Namen.") ;
    }

}else{
    Core::sendHTTPResponse(400, "Bitte gib sowohl Deinen Benutzernamen als auch Dein Passwort ein.") ;
}
