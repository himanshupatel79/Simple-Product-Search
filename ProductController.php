<?php
/**
 * Simple Product Search class
 * API Documentation: https://github.com/himanshupatel79/Simple-Product-Search
 *
 * @author Himanshu Patel
 * @since 06.06.2017
 * @copyright Himanshu Patel OORJA LTD
 * @version 1.0
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 */
class ProductController implements IElasticSearchDriver,IMySQLDriver
{

    protected $products;
    protected $c;
    protected $requests;
    protected $cache;
    private $products_list;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache, $products_list)
    {
        $this->requests = 1;
        $this->c = $cache;
        $this->products_list = $products_list;
    }

    /**
     * @param $product_id
     * @param null $product_name
     * @throws Exception
     * Request with product id comes in
     */
    public function store($product_id)
    {

        if ($this->c->isCached($product_id)) { //If product is cached retrieve from cache.

            // get cached data by its key
            $result = $this->c->retrieve($product_id);
            $this->c->erase($product_id); //Delete existing cache file
            $this->c->store($product_id, array( //Create new Cache file with updated details
                'name' => $this->products_list[$product_id],
                'requests' => $result['requests'] + 1 //Increment the number of requests for given product.//
            ));
        } else {
            //If product is not cached retrieve from ElasticSearch/MySQL and add to cache
            $data =  $this->findById($product_id);
            //Store detail in to the Cache file
            $this->c->store($data['product_id'], array(
                'name' => $data['product_name'],
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

        //Return product data in JSON.
        return json_encode($this->products);
    }

    /**
     * @param string $id
     * @return array
     */
    public function findById($id){
        return array(
            'product_id' => $id,
            'product_name' => $this->products_list[$id]
        );
    }

    /**
     * @param string $id
     * @return array
     */
    public function findProduct($id){
        return array(
            'product_id' => $id,
            'product_name' => $this->products_list[$id]
        );
    }
}


interface IElasticSearchDriver
{
    /**
     * @param string $id
     * @return array
     */
    public function findById($id);
}

interface IMySQLDriver
{
    /**
     * @param string $id
     * @return array
     */
    public function findProduct($id);
}