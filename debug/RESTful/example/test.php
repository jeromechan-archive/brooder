<?php
/**
 * Coypright © 2013 Neilsen-Chan. All rights reserved.
 * Author: chenjinlong
 * Date: 3/21/13
 * Time: 5:08 PM
 * Description: index.php
 */
//require_once '../index.php';
echo 1;

class Test
{
    function tRESTful()
    {
        $client = new RESTClient();
        $jsonStr = '{"accountId":"1","token":"","r":0,"searchType":2,"productType":1,"start":0,"limit":10}';
        $url = 'http://buckbeek-branch.tuniu.com/bb/product/allproduct';
        $param = json_decode($jsonStr, true);
        $result = $client->get($url, $param);
        var_dump($url, $param, $result, base64_encode(json_encode($param)));
    }
}