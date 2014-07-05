<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: Login.php
 */ 
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/User');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['level'] = $this->getSession('level');
        $this->load->view('header/normal', $data);
        $this->load->view('navigator/topbar');
        $this->load->view('login');
        $this->load->view('footer/normal');
    }

    public function check()
    {
        $userProfile = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        );
        $validation = $this->User->validateUser($userProfile);
        if($validation){
            $this->setSession(
                array(
                    'user_id'=>$validation['id'],
                    'username'=>$validation['username'],
                    'level' => $validation['level'],
                )
            );
            redirect('entry');
        }else{
            redirect('login');
        }
    }

    public function setSession($userProfile)
    {
        $userId = $userProfile['user_id'];
        $username = $userProfile['username'];
        $level = $userProfile['level'];

        $sessionData = array(
            'user_id' => $userId,
            'username' => $username,
            'level' => $level,
        );
        $this->session->set_userdata($sessionData);
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
