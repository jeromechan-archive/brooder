<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: index.php
 */
class Entry extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->helper('url');
        $data['level'] = $this->getSession('level');
        $this->load->view('header/normal', $data);
        $this->load->view('navigator/topbar');
        $this->load->view('entry');
        $this->load->view('footer/normal');
    }

    public function getSession($key='all')
    {
        if($key == 'all'){
            return $this->session->all_userdata();
        }else{
            return $this->session->userdata($key);
        }
    }
}
