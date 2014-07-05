<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Coypright © 2013 Neilsen.Chan. All rights reserved.
 * Author: chenjinlong
 * Date: 6/4/13
 * Time: 8:15 PM
 * Description: User.php
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        echo 123456;
    }

    public function login($pars)
    {
        echo $pars;
        $data = array();
        $data['pars'] = $pars;
        $data['dt'] = array(1,2,3,4,);
        $this->load->view('user_login', $data);
    }

    public function getUser()
    {
        $data['userList'] = $this->user_model->get_user(1900);
        var_dump($data);
    }

    public function insUser()
    {
        $queryResult = $this->user_model->ins_user();
        var_dump($queryResult);
    }

    public function updUser()
    {
        $this->benchmark->mark('code_start');
        $queryResult = $this->user_model->upd_user();
        var_dump($queryResult);

        $this->benchmark->mark('code_end');
        echo $this->benchmark->elapsed_time('code_start', 'code_end');

        $this->load->library('calendar');
        echo $this->calendar->generate();
    }

}
