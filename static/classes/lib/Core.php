<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 19.08.2015
 * Time: 12:55
 */

class Core {

    public static function convertToJSON($array){
        return json_encode($array) ;
    }

    public static function sendHTTPResponse($statusCode, $message = "", $data = null){
        header($_SERVER['SERVER_PROTOCOL'].' '.$statusCode.' '.$message, true, $statusCode);
        print self::convertToJSON(array('statusCode' => $statusCode, 'message' => $message, 'data' => $data));
    }

}