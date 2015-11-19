<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 19.11.2015
 * Time: 15:57
 */

require_once '../../initApplication.php' ;

print json_encode(ContentModel::getPublicContent());