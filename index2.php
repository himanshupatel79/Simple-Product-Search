<?php
/**
 * Created by PhpStorm.
 * User: Himanshu
 * Date: 06/06/2017
 * Time: 08:33
 */

//use classmap;
define("CACHETYPE", "cache");

//require 'vendor/autoload.php';
require_once 'ProductController.php';

$pc = new ProductController();
$pc->store(1000012,'TV');
$pc->detail(20000);
