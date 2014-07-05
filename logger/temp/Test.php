<?php
/**
 * Coypright © 2013 Tuniu Inc. All rights reserved.
 * Author: chenjinlong
 * Date: 6/4/13
 * Time: 1:46 PM
 * Description: test.php
 */
class Test
{

}

echo 1;
require_once '../vendor/apache/log4php/src/main/php/Logger.php';

Logger::configure('config-example.xml');

$logger = Logger::getLogger('debug-logger');
//$logger = Logger::getRootLogger();

$logger->error('helo');

$a = array(1,2,3,);
$logger->error($a);

$logger = Logger::getLogger('debug-logger2');
$logger->error('helo');


$output = fopen('php://stdout', 'w');
ob_start();

$a = array(1,2,3,);
$logger->error($logger);

$ob_contents = ob_get_contents();
ob_end_clean();
var_dump($ob_contents);