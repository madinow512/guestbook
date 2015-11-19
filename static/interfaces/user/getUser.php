<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 14:22
 */


require_once '../../initApplication.php';

print json_encode(array("username" => CustomSessionHandler::getSessionParamByKey(USER)));