<?php

namespace app\common\lib;

/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 2018/7/17
 * Time: 15:06
 */
class Redis
{
   /**
    * 验证码 redis key的前缀
    *@var string
    */

    public static $pre="sms_";

    /**
     * 用户user pre
     * @var string
     */
    public static $userpre="user_";

    /**
     * 存储验证码 redis key
     * @param $phone
     * @return string
     */

    public static function smsKey($phone)
    {
        return self::$pre.$phone;
    }

    /**
     * 用户key
     * @param $phone
     * $return string
     */

    public static function userKey($phone)
    {
        return self::$userpre.$phone;

    }


}