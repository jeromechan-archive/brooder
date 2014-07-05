<?php
/**
 * Coypright © 2013 Tuniu Inc. All rights reserved.
 * Author: chenjinlong
 * Date: 6/5/13
 * Time: 4:16 PM
 * Description: TestClient.php
 */ 
class TestClient extends CI_Controller
{
    public function cli_01()
    {
        // Load the rest client spark
        $this->load->spark('restclient/2.1.0');

        // Load the library
        $this->load->library('rest');

        /*// Run some setup
        $this->rest->initialize(array('server' => 'http://twitter.com/'));

        // Pull in an array of tweets
        $tweets = $this->rest->get('statuses/user_timeline/jessechan.xml');*/

        $user = 'github';

        $this->rest->initialize(array('server' => 'https://api.github.com/'));
        $this->rest->option(CURLOPT_SSL_VERIFYPEER, FALSE);
        $repos = $this->rest->get('users/'.$user.'/repos');

        var_dump($repos);
    }

    //GET METHOD
    public function cli_02()
    {
        // Load the rest client spark
        $this->load->spark('restclient/2.1.0');

        $this->load->library('rest', array('server' => 'http://lbs-cspt.github.com/'));

        $repos = $this->rest->get('api/test', array('id'=>1900));

        var_dump($repos);
    }

    //POST METHOD
    public function cli_03()
    {
        // Load the rest client spark
        $this->load->spark('restclient/2.1.0');

        $this->load->library('rest', array('server' => 'http://lbs-cspt.github.com/'));

        $repos = $this->rest->post('api/test', array('id'=>1901));

        var_dump($repos);
    }

}
