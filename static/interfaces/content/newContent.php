<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 19.11.2015
 * Time: 15:32
 */

require_once '../../initApplication.php' ;

if(isset($_POST['title']) && isset($_POST['message'])){

    $contentModel = new ContentModel();
    $contentModel->setTitle($_POST['title']);
    $contentModel->setMessage($_POST['message']);

    $isPublicContent = isset($_POST['username']);

    if($isPublicContent){
        $contentModel->setUsername($_POST['username']);
    }else{
        $contentModel->setUserID(UserModel::getUserByName(CustomSessionHandler::getSessionParamByKey(USER))->getID());
    }

    $contentModel->save();

    Core::sendHTTPResponse(200, "Vielen Dank für Deinen Beitrag.");

}else{
    Core::sendHTTPResponse(400, "Bitte gib sowohl einen Titel als auch eine Nachricht für Deinen Beitrag ein.");
}