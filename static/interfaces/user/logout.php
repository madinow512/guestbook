<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 23:08
 */

require_once '../../initApplication.php' ;

CustomSessionHandler::destroySession();

Core::sendHTTPResponse(200, "Du wurdest abgemeldet.");
