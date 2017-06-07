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

//First Request of TV
$pc->store(1000012,'TV');
$pc->store(1000011,'Mobile');
//Second Request of TV
$pc->store(1000012,'TV');

//retrieve all products data in to JSON Format
$pc->detail();

//retrieve specific product data in to JSON Format
$pc->detail(1000012);
