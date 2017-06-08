<?php
/**
 * Created by PhpStorm.
 * User: Himanshu
 * Date: 08/06/2017
 * Time: 01:06
 */
namespace Tests;

class ProductControllerTest extends \PHPUnit_Framework_TestCase {


    public function testList()
    {
        $list = array(
            1000011 => 'Mobile',
            1000012 => 'TV',
            1000013 => 'Freeze',
            1000014 => 'Freezer',
            1000015 => 'Test Non Cache Product');
      //  $this->assertCount(5, count($list));
        $this->assertEquals('Mobile', $list[1000011]);


    }

/*    public function testJSON(){

        $list = array(
            1000011 => 'Mobile',
            1000012 => 'TV',
            1000013 => 'Freeze',
            1000014 => 'Freezer',
            1000015 => 'Test Non Cache Product');

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

        $this->assertEquals('{"name":"TV","requests":12}', $pc->detail(1000012));

    }*/
}
