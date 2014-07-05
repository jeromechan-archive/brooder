<?php
/**
 * Coypright © 2013 Tuniu Inc. All rights reserved.
 * Author: chenjinlong
 * Date: 3/30/13
 * Time: 3:03 PM
 * Description: index.php
 */

//header("Expires: 0");
//die;


spl_autoload_register();

$restServerObject = new RESTServer();
$restServerObject->addClass('TestController');

//

//var_dump($restServerObject);

$restServerObject->handle();