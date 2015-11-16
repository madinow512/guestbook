<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 14:22
 */

if(isset($_GET['id'])){

    require_once '../initApplication.php';

    $id = $_GET['id'] ;

    print json_encode(UserModel::getUserByID($id));

}