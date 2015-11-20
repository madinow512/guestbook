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
    $contents = array();
    if(isset($_GET['limit']) && isset($_GET['offset'])){
        $limit = $_GET['limit'];
        $offset = $_GET['offset'] ;
    }
    $mode = $_GET['mode'];
    if($mode === 'private'){
        $contents = ContentModel::getPrivateContent($limit, $offset);
    }else if($mode === 'public'){
        $contents = ContentModel::getPublicContent($limit, $offset);
    }
    if(!CustomSessionHandler::doesSessionParamExist(LATEST_CONTENT) || CustomSessionHandler::getSessionParamByKey(LATEST_CONTENT) !== $contents[0]->getID()){
        $results = array();
        foreach ($contents as $c) {
            if($c->getID() > CustomSessionHandler::getSessionParamByKey(LATEST_CONTENT)){
                array_push($results, $c);
            }else{
                break ;
            }
        }
        CustomSessionHandler::bindNewSessionParam(LATEST_CONTENT, $contents[0]->getID());
        print json_encode($results);
    }else{
        print json_encode(array());
    }
}else{
    Core::sendHTTPResponse(400, "Es ist ein Fehler beim Laden der Beiträge aufgetreten.");
}

