<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 16.11.2015
 * Time: 14:22
 */


require_once '../../initApplication.php';

print strpos("hello World", "World");

print UserModel::getUserByName('mady512');