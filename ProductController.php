<?php
/**
 * Created by PhpStorm.
 * User: Himanshu
 * Date: 06/06/2017
 * Time: 08:11
 */

require_once 'cache.class.php';
//namespace classmap;

class ProductController extends Cache{

    public $products;
    public $c;
    public $requests =1;
    public function __construct() {
        print "In constructor\n";


       $this->c = new Cache();

/*        // store a string
        $this->c->store('1000', array(
            'name' => 'TV',
            'requests' => 0
        ));

        // generate a new cache file with the name 'newcache'
      //  $c->setCache('newcache');

        // store an array of product id and name as key and value pair
        $this->c->store('products', array(
            '10000' => 'TV',
            '20000' => 'Mobile',
            '30000' => 'Car',
            '40000' => 'Washing Machine'
        ));

        // get cached data by its key
        $this->products = $this->c->retrieve('products')*/;


    }

    public function store($product_id, $product_name){

        if($this->c->isCached($product_id)){
            // get cached data by its key
            $result = $this->c->retrieve($product_id);
//echo $result['requests']++;
            $this->c->erase($product_id);
            $this->c->store($product_id, array(
                'name' => $product_name,
                'requests' => $result['requests'],
                'exist'     => 1
            ));
        }else{

            $this->c->store($product_id, array(
                'name' => $product_name,
                'requests' => $this->requests,
                'exist'     => 0
            ));
        }

        $this->products = $this->c->retrieve($product_id);
    }
    /**
     * @param string $id
     * @return string
     */
    public function detail($id)
    {

//Request with product id comes in.
      //  $product_id =  $this->products[$id];

        // display the cached array
        echo '<pre>';
        print_r($this->products);
        echo '<pre>';

        // grab array entry
        var_dump($this->c->isCached($this->products[$id]));


//If product is cached retrieve from cache.

//If product is not cached retrieve from ElasticSearch/MySQL and add to cache.
//Increment the number of requests for given product.
//Return product data in JSON.
        // do stuff and return json
    }
}