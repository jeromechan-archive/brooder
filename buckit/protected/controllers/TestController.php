<?php

class TestController extends CController {

    public $layout = '//layouts/site';

    function actionIndex() {
        //var_dump($_SERVER);
        $this->render('index');
    }

}