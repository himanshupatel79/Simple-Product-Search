<?php
/**
 * Created by PhpStorm.
 * User: Himanshu
 * Date: 06/06/2017
 * Time: 08:11
 */

require_once 'cache.class.php';

//namespace classmap;

class ProductController extends Cache
{

    public $products;
    public $c;
    public $requests;

    public function __construct()
    {
        $this->$requests = 1;
        $this->c = new Cache();
    }

    /**
     * @param string $product_id
     * @param mixed $product_name
     * @throws Exception
     * Request with product id comes in.
     */
    public function store($product_id, $product_name)
    {

        if ($this->c->isCached($product_id)) { //If product is cached retrieve from cache.
            // get cached data by its key
            $result = $this->c->retrieve($product_id);
            $this->c->erase($product_id); //Delete existing cache file
            $this->c->store($product_id, array( //Create new Cache file with updated details
                'name' => $product_name,
                'requests' => $result['requests']++ //Increment the number of requests for given product.//
            ));
        } else {
            //If product is not cached retrieve from ElasticSearch/MySQL and add to cache
            $this->c->store($product_id, array(
                'name' => $product_name,
                'requests' => $this->requests
            ));
        }
    }

    /**
     * @param string $id
     * @return string
     */
    public function detail($product_id=null)
    {

        if (isset($product_id)){
            $this->products = $this->c->retrieve($product_id);
        }else{
            $this->products = $this->c->retrieveAll();
        }
        // display the cached array in JSON format
/*        echo '<pre>';
        print_r($this->products);
        echo '<pre> JSON';*/
        echo json_encode($this->products);
        return json_encode($this->products);


//Return product data in JSON.
        // do stuff and return json
    }
}