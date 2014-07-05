<?php
/**
 * Coypright © 2013 Tuniu Inc. All rights reserved.
 * Author: chenjinlong
 * Date: 6/4/13
 * Time: 6:36 PM
 * Description: TestRenderer.php
 */
require_once '../vendor/apache/log4php/src/main/php/renderers/LoggerRenderer.php';
class TestRenderer implements LoggerRenderer
{
    public function render($testObject)
    {
        return new stdClass();
    }

}
