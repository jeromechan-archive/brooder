<?php
/**
 * Coypright © 2013 Neilsen-Chan. All rights reserved.
 * Author: chenjinlong
 * Date: 3/21/13
 * Time: 5:08 PM
 * Description: index.php
 */
require_once dirname(__FILE__) . '/core/RESTClient.php';

$func = trim(strval($_GET['f']));
$cls = trim((strval($_GET['c'])));
$result = array();
if(!empty($func) && !empty($cls)){
    require_once dirname(__FILE__) . '/example/' . $cls . '.php';
    $object = new $cls;
    $object->$func();
}else{
    throw new Exception('Invalid format of parameters.');
}
