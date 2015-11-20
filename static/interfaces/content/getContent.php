<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 19.11.2015
 * Time: 15:57
 */

require_once '../../initApplication.php' ;

$mode = null ;
$offset = 0 ;
$limit = 10 ;

if(isset($_GET['mode'])){
    $result = array();
    if(isset($_GET['limit']) && isset($_GET['offset'])){
        $limit = $_GET['limit'];
        $offset = $_GET['offset'] ;
    }
    $mode = $_GET['mode'];
    if($mode === 'private'){
        $result = ContentModel::getPrivateContent($limit, $offset);
    }else if($mode === 'public'){
        $result = ContentModel::getPublicContent($limit, $offset);
    }
    print json_encode($result);
}else{
    Core::sendHTTPResponse(400, "Es ist ein Fehler beim Laden der Beiträge aufgetreten.");
}

