<?php
/**
 * Coypright © 2013 Tuniu Inc. All rights reserved.
 * Author: chenjinlong
 * Date: 3/30/13
 * Time: 3:03 PM
 * Description: TestController.php
 */ 
class TestController 
{
    /**
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     * @url GET /RESTful/test/users/1
     */
    public function test()
    {
        return "Hello World";
    }

    /**
     * Gets the user by id or current user
     *
     * @url GET /users/:id
     * @url GET /RESTful/test/users/current
     */
    public function getUser($id = null)
    {
        if ($id) {
            $user = User::load($id); // possible user loading method
        } else {
            $user = $_SESSION['user'];
        }

        return 'chenjinlong'; // serializes object into JSON
    }

}
