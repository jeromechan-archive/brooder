<?php
/**
 * Copyright © 2014 Jerome Chan. All rights reserved.
 * 
 * @author chenjinlong
 * @date 7/12/14
 * @time 6:16 PM
 * @description MActiveRecord.php
 */
class MActiveRecord extends CActiveRecord
{
    public static $dbConnection = 'tj_master';

    public function getDbConnection()
    {
        if(self::$db!==null)
            return self::$db;
        else
        {
            self::$db=Yii::app()->{self::$dbConnection};
            if(self::$db instanceof CDbConnection)
                return self::$db;
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}