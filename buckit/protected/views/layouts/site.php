<?php
/**
 * Created by PhpStorm.
 * User: neilsenchan
 * Date: 12/30/13
 * Time: 5:31 PM
 */
Yii::app()->bootstrap_3->register();
require dirname(__FILE__) . '/header.php';
echo $content;
require dirname(__FILE__) . '/footer.php';