<?php
/**
 * Copyright © 2014 Jerome Chan. All rights reserved.
 * 
 * @author chenjinlong
 * @date 7/12/14
 * @time 5:56 PM
 * @description TjUserFinance.php
 */
class TjUserFinance extends MActiveRecord
{
    public $id;

    public $user_id;

    public $balance;

    public $all_balance;

    public $add_time;

    public $update_time;

    public $del_flag;

    public $misc;

    public function tableName()
    {
        return 'tj_user_finance';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @param mixed $add_time
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;
    }

    /**
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * @param mixed $all_balance
     */
    public function setAllBalance($all_balance)
    {
        $this->all_balance = $all_balance;
    }

    /**
     * @return mixed
     */
    public function getAllBalance()
    {
        return $this->all_balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $del_flag
     */
    public function setDelFlag($del_flag)
    {
        $this->del_flag = $del_flag;
    }

    /**
     * @return mixed
     */
    public function getDelFlag()
    {
        return $this->del_flag;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $misc
     */
    public function setMisc($misc)
    {
        $this->misc = $misc;
    }

    /**
     * @return mixed
     */
    public function getMisc()
    {
        return $this->misc;
    }

    /**
     * @param mixed $update_time
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}