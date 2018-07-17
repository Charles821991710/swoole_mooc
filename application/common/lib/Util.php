<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 2018/7/17
 * Time: 15:23
 */

namespace app\common\lib;


class Util
{
    /**
     * API 输出格式
     * @param $string
     * @param string $message
     * @param array $data
     */

    public static function show($status, $message = '', $data = [])
    {
        $result=[
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
        ];
        echo json_encode($result);

    }

}