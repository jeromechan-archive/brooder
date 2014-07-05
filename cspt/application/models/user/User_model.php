<?php
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: User_model.php
 */ 
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function queryAllUserPager($conditions)
    {
        $offset = $conditions['offset'];
        $limit = $conditions['limit'];
        $rows = $this->db->get_where('cspt_user', array('del_flag'=>0), $limit, $offset)->result_array();
        return $rows;
    }

    public function querySpecificUser($conditions)
    {
        $username = $conditions['username'];
        $rows = $this->db->get_where('cspt_user', array('del_flag'=>0,'username'=>$username))->row_array();
        return $rows;
    }
}
