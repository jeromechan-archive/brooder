<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * Date: 6/5/13
 * Description: Test.php
 */
require APPPATH.'/libraries/restserver/REST_Controller.php';
class Test extends REST_Controller
{
    public function index_get()
    {
        // Display all books
        //echo 'get-func';
        $id = $this->get('id');
        $this->response(array('id1'=>1,'id2'=>2,'pars3'=>$id,), 200);
    }

    public function index_post()
    {
        // Create a new book
        //echo 'post-func';
        $id = $this->post('id');
        $this->response(array('id1'=>1,'id2'=>2,'pars3'=>$id,), 200);
    }

}
