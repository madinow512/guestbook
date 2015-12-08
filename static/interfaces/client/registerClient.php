<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 21.11.2015
 * Time: 00:02
 */

require_once '../../initApplication.php' ;

CustomSessionHandler::bindNewSessionParam(LATEST_CONTENT, -1);

Core::sendHTTPResponse(200, "", array());