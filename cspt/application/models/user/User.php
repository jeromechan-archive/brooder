<?php
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: User.php
 */
require_once 'application/models/user/User_model.php';

class User extends LBS_Model
{
    private $_userModel;

    public function __construct()
    {
        $this->_userModel = new User_model();
    }

    public function validateUser($userProfile)
    {
        if(empty($userProfile['username'])){
            return false;
        }else{
            $username = $userProfile['username'];
            $password = $userProfile['password'];

            $queryParams = array(
                'username' => $username,
            );
            $userInfo = $this->_userModel->querySpecificUser($queryParams);
            if($username == $userInfo['username'] && md5($password) == $userInfo['password']){
                return $userInfo;
            }else{
                return false;
            }
        }
    }

}
