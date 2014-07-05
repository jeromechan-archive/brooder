<?php
/**
 * Coypright © 2013 Neilsen.Chan. All rights reserved.
 * Author: chenjinlong
 * Date: 6/5/13
 * Time: 4:58 PM
 * Description: user_model.php
 */
/*
 * SHOW CREATE TABLE user;
   CREATE TABLE `user` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(128) NOT NULL,
        `level` varchar(128) NOT NULL,
        `misc` text NOT NULL,
        PRIMARY KEY (`id`),
        KEY `name` (`name`)
   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
*/
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_user($name)
    {
        if ($name === FALSE)
        {
            $query = $this->db->get('user');
            return $query->result_array();
        }

        $query = $this->db->get_where('user', array('name' => $name));

        $result = $query->row_array();
        return $query;
    }

    public function ins_user()
    {
        $this->load->helper('url');

        /*$slug = url_title($this->input->post('title'), 'dash', TRUE);
        $this->input->post('title');*/

        $data = array(
            'name' => 'name-ins-test',
            'level' => 19,
            'misc' => 'misc-ins-test'
        );

        return $this->db->insert('user', $data);
    }

    public function upd_user()
    {
        $this->load->helper('url');

        /*$slug = url_title($this->input->post('title'), 'dash', TRUE);
        $this->input->post('title');*/

        $set = array(
            'level' => 20,
            'misc' => 'misc-ins-test-upd'
        );
        $where = array(
            'name' => '1900',
        );
        $limit = 1;

        return $this->db->update('user', $set, $where, $limit);
    }


}