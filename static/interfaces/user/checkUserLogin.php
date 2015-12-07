<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 14:47
 */

require_once '../../initApplication.php';

$loggedIn = CustomSessionHandler::doesSessionParamExist(USER);

Core::sendHTTPResponse(200, "", $loggedIn);