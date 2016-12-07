<?php
/**
 * Copyright © 2014 Jerome Chan. All rights reserved.
 * 
 * @author chenjinlong
 * @date 7/12/14
 * @time 5:20 PM
 * @description UserController.php
 */
class UserController extends RestServer
{
    private $_userInfoMod;

    public function __construct()
    {
        $this->_userInfoMod = new UserInfoMod();
    }

    /**
     * 测试GET接口
     *
     * @param $urlVar
     * @param $getPars
     */
    public function actionGetTest($urlVar, $getPars)
    {
        phpinfo();
    }

    /**
     * 注册接口
     *
     * @param $postPars
     */
    public function actionPostRegister($postPars)
    {
        $postPars = ToolFunction::arrKeysToUnderlineCase($postPars);
        $user_name = $postPars['user_name']; //注册之时，强制为手机号注册
        $password = $postPars['password'];
        if(empty($user_name) || empty($password))
            $this->returnRest(array(), 0, 20002, ErrorCodeDict::getDescByCode(20002));
        else{
            $regParams = array(
                'user_name' => $user_name,
                'mobile_number' => $user_name,
                'password' => $password,
            );
            $result = $this->_userInfoMod->register($regParams);
            if($result['flag']){
                $finalReturn = array(
                    'user_id' => $result['user_info']->getUserId(),
                    'user_name' => $result['user_info']->getUserName(),
                    'nickname' => $result['user_info']->getNickname(),
                    'password' => $result['user_info']->getPassword(),
                    'mobile_number' => $result['user_info']->getMobileNumber(),
                    'sex' => $result['user_info']->getSex(),
                    'email' => $result['user_info']->getEmail(),
                    'balance' => $result['user_finance']->getBalance(),
                    'all_balance' => $result['user_finance']->getAllBalance(),
                    'alipay_name' => $result['user_info']->getAlipayName(),
                    'alipay_number' => $result['user_info']->getAlipayNumber(),
                );
                $finalReturn = ToolFunction::arrKeysToCamelCase($finalReturn);
                $this->returnRest($finalReturn, 1);
            }else{
                $this->returnRest(array(), 0, 20003, ErrorCodeDict::getDescByCode(20003));
            }
        }
    }

    /**
     * 登录接口
     *
     * @param $postPars
     */
    public function actionPostLogin($postPars)
    {
        $postPars = ToolFunction::arrKeysToUnderlineCase($postPars);
        $user_name = $postPars['user_name']; //登录之时，兼容用户名、手机号或邮箱
        $password = $postPars['password'];
        if(empty($user_name) || empty($password))
            $this->returnRest(array(), 0, 20002, ErrorCodeDict::getDescByCode(20002));
        else{
            $regParams = array(
                'login_name_str' => $user_name,
                'password' => $password,
            );
            $result = $this->_userInfoMod->login($regParams);
            if($result['flag']){
                $finalReturn = array(
                    'user_id' => $result['user_info']->getUserId(),
                    'user_name' => $result['user_info']->getUserName(),
                    'nickname' => $result['user_info']->getNickname(),
                    'password' => $result['user_info']->getPassword(),
                    'mobile_number' => $result['user_info']->getMobileNumber(),
                    'sex' => $result['user_info']->getSex(),
                    'email' => $result['user_info']->getEmail(),
                    'balance' => $result['user_finance']->getBalance(),
                    'all_balance' => $result['user_finance']->getAllBalance(),
                    'alipay_name' => $result['user_info']->getAlipayName(),
                    'alipay_number' => $result['user_info']->getAlipayNumber(),
                );
                $finalReturn = ToolFunction::arrKeysToCamelCase($finalReturn);
                $this->returnRest($finalReturn, 1);
            }else{
                $this->returnRest(array(), 0, 20004, ErrorCodeDict::getDescByCode(20004));
            }
        }
    }

    /**
     * 修改个人资料接口
     *
     * @param $postPars
     */
    public function actionPostChangePersonalData($postPars)
    {
        $postPars = ToolFunction::arrKeysToUnderlineCase($postPars);
        $userId = $postPars['user_id'];
        $userName = $postPars['user_name'];
        $mobileNumber = $postPars['mobile_number'];
        $email = $postPars['email'];
        $sex = $postPars['sex'];
        if(empty($userName) || empty($mobileNumber))
            $this->returnRest(array(), 0, 20002, ErrorCodeDict::getDescByCode(20002));
        else{
            $changeParams = array(
                'user_name' => $userName,
                'mobile_number' => $mobileNumber,
                'sex' => $sex,
                'email' => $email,
            );
            $conditionParams = array(
                'user_id' => $userId,
            );
            $result = $this->_userInfoMod->updateUserProfile($changeParams, $conditionParams);
            if($result['flag']){
                $finalReturn = array(
                    'user_id' => $result['user_info']->getUserId(),
                    'user_name' => $result['user_info']->getUserName(),
                    'nickname' => $result['user_info']->getNickname(),
                    'password' => $result['user_info']->getPassword(),
                    'mobile_number' => $result['user_info']->getMobileNumber(),
                    'sex' => $result['user_info']->getSex(),
                    'email' => $result['user_info']->getEmail(),
                    'balance' => $result['user_finance']->getBalance(),
                    'all_balance' => $result['user_finance']->getAllBalance(),
                    'alipay_name' => $result['user_info']->getAlipayName(),
                    'alipay_number' => $result['user_info']->getAlipayNumber(),
                );
                $finalReturn = ToolFunction::arrKeysToCamelCase($finalReturn);
                $this->returnRest($finalReturn, 1);
            }else{
                $this->returnRest(array(), 0, 20004, ErrorCodeDict::getDescByCode(20004));
            }
        }
    }

    /**
     * 修改密码接口
     *
     * @param $postPars
     */
    public function actionPostChangePassword($postPars)
    {
        $postPars = ToolFunction::arrKeysToUnderlineCase($postPars);
        $userId = $postPars['user_id'];
        $oldPassword = $postPars['old_password'];
        $newPassword = $postPars['new_password'];
        if(empty($userId) || empty($oldPassword) || empty($newPassword))
            $this->returnRest(array(), 0, 20002, ErrorCodeDict::getDescByCode(20002));
        else{
            $changeParams = array(
                'old_password' => $oldPassword,
                'new_password' => $newPassword,
            );
            $conditionParams = array(
                'user_id' => $userId,
            );
            $result = $this->_userInfoMod->updateUserPassword($changeParams, $conditionParams);

            if($result['flag']){
                $this->returnRest(array(), 1);
            }else{
                $this->returnRest(array(), 0, 20005, ErrorCodeDict::getDescByCode(20005));
            }
        }
    }

    /**
     * 设置支付宝信息
     *
     * @param $postPars
     */
    public function actionPostSetAlipayInfo($postPars)
    {
        $postPars = ToolFunction::arrKeysToUnderlineCase($postPars);
        $userId = $postPars['user_id'];
        $alipayName = $postPars['alipay_name'];
        $alipayNumber = $postPars['alipay_number'];
        if(empty($userId))
            $this->returnRest(array(), 0, 20002, ErrorCodeDict::getDescByCode(20002));
        else{
            $changeParams = array(
                'alipay_name' => $alipayName,
                'alipay_number' => $alipayNumber,
            );
            $conditionParams = array(
                'user_id' => $userId,
            );
            $result = $this->_userInfoMod->updateUserAlipay($changeParams, $conditionParams);
            if($result['flag']){
                $this->returnRest(array(), 1);
            }else{
                $this->returnRest(array(), 0, 20006, ErrorCodeDict::getDescByCode(20006));
            }
        }
    }
}