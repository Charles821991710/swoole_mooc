<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 2018/7/17
 * Time: 15:02
 */

namespace app\index\controller;

use app\common\lib\ali\Sms;
use app\common\lib\Util;
use app\common\lib\Redis;


class Send
{
    /**
     * 发送验证码
     */

    public function index()
    {
        //$phoneNum = request()->get('phone_num', 0, 'intval');
        //$phoneNum=intval($_GET['phone_num']);

        $phoneNum=13232809689;

        if(empty($phoneNum)){

            return Util::show(config('code.error'),'error');
        }
        // 生成一个随机数
        $code = rand(1000, 9999);


        $redis = new \Swoole\Coroutine\Redis();

        $redis->connect(config('redis.host'),config('redis.port'));

        $redis->set(Redis::smsKey($phoneNum),$code,config('redis.out_time'));


        return 'success';

    }

}