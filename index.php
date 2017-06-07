<?php
/**
 * Created by PhpStorm.
 * User: Himanshu
 * Date: 06/06/2017
 * Time: 08:02
 */

    require_once 'cache.class.php';

    // setup 'default' cache
    $c = new Cache();

    // store a string
    $c->store('hello', 'Hello World!');

    // generate a new cache file with the name 'newcache'
    $c->setCache('newcache');

    // store an array
    $c->store('movies', array(
        'description' => 'Movies on TV',
        'action' => array(
            'Tropic Thunder',
            'Bad Boys',
            'Crank'
        )
    ));

    // get cached data by its key
    $result = $c->retrieve('movies');

    // display the cached array
    echo '<pre>';
    print_r($result);
    echo '<pre>';

    // grab array entry
    $description = $result['description'];

/*    // switch back to the first cache
    $c->setCache('mycache');

    // update entry by simply overwriting an existing key
    $c->store('hello', 'Hello everybody out there!');

    // erase entry by its key
    $c->erase('hello');*/