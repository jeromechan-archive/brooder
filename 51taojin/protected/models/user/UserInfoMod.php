<?php
/**
 * Copyright © 2014 Jerome Chan. All rights reserved.
 * 
 * @author chenjinlong
 * @date 7/12/14
 * @time 7:57 PM
 * @description UserInfoMod.php
 */
class UserInfoMod
{
    /**
     * 注册流程
     *
     * @param $regParams
     * @return array
     */
    public function register($regParams)
    {
        $userName = $regParams['user_name'];
        $mobileNumber = $regParams['mobile_number'];
        $password = $regParams['password'];

        $existUserInfo = TjUserInfo::model()->find(
            'del_flag=0 AND user_name=:user_name',
            array(':user_name' => $userName)
        );
        if(!empty($existUserInfo)){
            // Exists
            return array(
                'flag' => false,
                'msg' => '帐号已存在',
            );
        }else{
            // Insert
            $tjUserInfoObject = new TjUserInfo();
            $tjUserInfoObject->setUserName($userName);
            $tjUserInfoObject->setMobileNumber($mobileNumber);
            $tjUserInfoObject->setPassword(md5($password));
            $tjUserInfoObject->save();
            $userId = $tjUserInfoObject->getUserId();

            $tjUserFinanceObject = new TjUserFinance();
            $tjUserFinanceObject->setUserId($userId);
            $tjUserFinanceObject->save();

            return array(
                'flag' => true,
                'msg' => '新建帐号成功',
                'user_info' => $tjUserInfoObject,
                'user_finance' => $tjUserFinanceObject,
            );
        }
    }

    /**
     * 登录流程
     *
     * @param $loginParams
     * @return array
     */
    public function login($loginParams)
    {
        $loginNameStr = $loginParams['login_name_str'];
        $password = $loginParams['password'];
        $existUserInfo = TjUserInfo::model()->find(
            'del_flag=0 AND (user_name=:login_name_str OR email=:email OR mobile_number=:mobile_number)',
            array(
                ':login_name_str' => $loginNameStr,
                ':email' => $loginNameStr,
                ':mobile_number' => $loginNameStr,
            )
        );
        if(empty($existUserInfo)){
            //Not Exists
            return array(
                'flag' => false,
                'msg' => '帐号不存在',
            );
        }else{
            $userId = $existUserInfo->getUserId();
            $passwordExist = $existUserInfo->getPassword();
            if(md5($password) != $passwordExist){
                // Password doesn't match
                return array(
                    'flag' => false,
                    'msg' => '登录名或密码不正确',
                );
            }

            $existUserFinance = TjUserFinance::model()->find(
                'del_flag=0 AND user_id=:user_id',
                array(':user_id' => $userId)
            );

            return array(
                'flag' => true,
                'msg' => '查询成功',
                'user_info' => $existUserInfo,
                'user_finance' => $existUserFinance,
            );
        }
    }

    /**
     * 更新个人资料
     *
     * @param $userProfileParams
     * @param $conditionParams
     * @return array
     */
    public function updateUserProfile($userProfileParams, $conditionParams)
    {
        $userId = $conditionParams['user_id'];

        $userName = $userProfileParams['user_name'];
        $email = $userProfileParams['email'];
        $mobileNumber = $userProfileParams['mobile_number'];
        $sex = $userProfileParams['sex'];

        $existUserInfo = TjUserInfo::model()->findByPk($userId);
        if(empty($existUserInfo)){
            //Not Exists
            return array(
                'flag' => false,
                'msg' => '帐号不存在',
            );
        }else{
            $existUserInfo->setUserName($userName);
            $existUserInfo->setEmail($email);
            $existUserInfo->setMobileNumber($mobileNumber);
            $existUserInfo->setSex($sex);
            $existUserInfo->save();

            $existUserFinance = TjUserFinance::model()->find(
                'del_flag=0 AND user_id=:user_id',
                array(':user_id' => $userId)
            );

            return array(
                'flag' => true,
                'msg' => '查询成功',
                'user_info' => $existUserInfo,
                'user_finance' => $existUserFinance,
            );
        }
    }

    /**
     * 修改密码
     *
     * @param $userPasswordParams
     * @param $conditionParams
     * @return array
     */
    public function updateUserPassword($userPasswordParams, $conditionParams)
    {
        $userId = $conditionParams['user_id'];

        $oldPassword = $userPasswordParams['old_password'];
        $newPassword = $userPasswordParams['new_password'];

        $existUserInfo = TjUserInfo::model()->findByPk($userId);
        if(empty($existUserInfo)){
            // Not Exists
            return array(
                'flag' => false,
                'msg' => '帐号不存在',
            );
        }else{
            if(md5($oldPassword) == $existUserInfo->getPassword()){
                $existUserInfo->setPassword(md5($newPassword));
                $existUserInfo->setMisc('pre-password:' . $existUserInfo->getPassword());
                $existUserInfo->save();

                // Done
                return array(
                    'flag' => true,
                    'msg' => '修改成功',
                );
            }else{
                // Old password doesn't match
                return array(
                    'flag' => false,
                    'msg' => '原密码输入不正确',
                );
            }
        }
    }

    public function updateUserAlipay($alipayInfoParams, $conditionParams)
    {
        $userId = $conditionParams['user_id'];

        $alipayName = $alipayInfoParams['alipay_name'];
        $alipayNumber = $alipayInfoParams['alipay_number'];

        $existUserFinance = TjUserFinance::model()->find(
            'del_flag=0 AND user_id=:user_id',
            array(':user_id' => $userId)
        );
        $existUserFinance->setAlipayName($alipayName);
        $existUserFinance->setAlipayNumber($alipayNumber);
        $existUserFinance->save();

        // Done
        return array(
            'flag' => true,
            'msg' => '修改成功',
        );
    }

}