<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: test.php
 */ 
class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/User_model');
        $this->load->model('user/User');
    }

    public function index()
    {
        /*$params = array(
            'offset' => 0,
            'limit' => 10,
        );
        $result = $this->User_model->queryAllUserPager($params);*/

        $params = array(
            'username'=>'user2',
        );
        $result = $this->User_model->querySpecificUser($params);
        var_dump($result);
        $re = $this->User->validateUser(1);var_dump($re);
    }
}
