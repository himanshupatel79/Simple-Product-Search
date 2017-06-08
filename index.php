<?php
/**
 * Main index.php file to use Front Controller Design Pattern
 * API Documentation: https://github.com/himanshupatel79/Simple-Product-Search
 *
 * @author Himanshu Patel
 * @since 06.06.2017
 * @copyright Himanshu Patel OORJA LTD
 * @version 1.0
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 */

define("CACHETYPE", "cache");

$list = array(
    1000011 => 'Mobile',
    1000012 => 'TV',
    1000013 => 'Freeze',
    1000014 => 'Freezer',
    1000015 => 'Test Non Cache Product');

//require 'vendor/autoload.php';
require_once 'cache.class.php';

require_once 'ProductController.php';

$pc = new ProductController(new Cache,$list);

//First Request of TV
$pc->store(1000012);
//First Request of Mobile
$pc->store(1000011);
//Second Request of TV
$pc->store(1000012);

$pc->store(1000013);

$pc->store(1000015);
//retrieve all products data in to JSON Format
echo ' ALL -> '. $pc->detail();

//retrieve specific product data in to JSON Format
echo ' || Specific -> '.$pc->detail(1000012);
