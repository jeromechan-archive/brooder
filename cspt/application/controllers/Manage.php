<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: Manage.php
 */ 
class Manage extends CI_Controller
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
        if($data['level'] != 1){
            show_404();
        }
        $this->load->view('header/normal', $data);
        $this->load->view('navigator/topbar');
        $this->load->view('manage');
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
