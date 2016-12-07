<?php
/**
 * Copyright © 2014 Jerome Chan. All rights reserved.
 * 
 * @author chenjinlong
 * @date 7/12/14
 * @time 8:12 PM
 * @description error_code.php
 */
class ErrorCodeDict
{
    private static $_codeMap = array(
        // 系统级错误码
        '10001' => '系统更新中，请稍候',
        '10002' => '请升级至新版本',
        // 用户级错误码
        '20001' => '私密认证信息失败',
        '20002' => '参数不符合要求',
        '20003' => '用户已存在',
        '20004' => '登录失败，用户名或密码不正确',
        '20005' => '密码修改失败',
        '20006' => '支付宝信息修改失败',
        '20101' => '数据库操作失败',
        '20102' => '数据插入失败',
        '20201' => '手机号不符合要求',
        '20202' => '当日该手机号发送超过上限',
        '20203' => '手机在黑名单列表中',
    );

    public static function getDescByCode($code)
    {
        return self::$_codeMap[$code];
    }
}