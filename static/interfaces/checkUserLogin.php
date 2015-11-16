<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 14:47
 */

require_once '../initApplication.php';

header('Access-Control-Allow-Origin: *');
print json_encode(CustomSessionHandler::doesSessionParamExist(USER));