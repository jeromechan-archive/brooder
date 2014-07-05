<?php
/**
 * Coypright © 2013 Neilsen.Chan All rights reserved.
 * Author: chenjinlong
 * Date: 6/8/13
 * Time: 9:17 AM
 * Description: LBSLogger.php
 */
//独立模块使用
//require_once 'log4php/src/main/php/Logger.php';
//Logger::configure('config.xml');

//集成项目使用
require_once dirname(__FILE__).'/log4php/src/main/php/Logger.php';
Logger::configure(dirname(__FILE__).'/config.xml');

class LBSLogger
{
    private static $_logger;

    function __construct()
    {
    }

    /**
     * 常用Logger枚举
     *
     * 数据库日志：NEUTRAL_dblogger
     * 文件继承日志：ERROR_dfilelogger.WARN_dfilelogger.INFO_dfilelogger
     * 自定义日志：输入参数包含自定义logger的明确指向
     */
    private static function iniLogger($logger = null)
    {
        switch($logger)
        {
            case 'file':
                $realLogger = 'ERROR_dfilelogger.WARN_dfilelogger.INFO_dfilelogger';
                break;
            case 'db':
                $realLogger = 'NEUTRAL_dblogger';
                break;
            default:
                $realLogger = $logger;
                break;
        }
        if(!empty($realLogger)){
            self::$_logger = Logger::getLogger($realLogger);
        }else{
            self::$_logger = Logger::getRootLogger();
        }
    }

    public static function trace($content, $logger = null, $throwable = null)
    {
        self::iniLogger($logger);
        self::$_logger->trace($content, $throwable);
    }

    public static function debug($content, $logger = null, $throwable = null)
    {
        self::iniLogger($logger);
        self::$_logger->debug($content, $throwable);
    }

    public static function info($content, $logger = null, $throwable = null)
    {
        self::iniLogger($logger);
        self::$_logger->info($content, $throwable);
    }

    public static function warn($content, $logger = null, $throwable = null)
    {
        self::iniLogger($logger);
        self::$_logger->warn($content, $throwable);
    }

    public static function error($content, $logger = null, $throwable = null)
    {
        self::iniLogger($logger);
        self::$_logger->error($content, $throwable);
    }

    public static function fatal($content, $logger = null, $throwable = null)
    {
        self::iniLogger($logger);
        self::$_logger->fatal($content, $throwable);
    }

}
