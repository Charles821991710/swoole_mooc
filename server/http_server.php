<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 18/2/28
 * Time: 上午1:39
 */
$http = new swoole_http_server("0.0.0.0", 8811);

$http->set(
    [
        'enable_static_handler' => true,
        'document_root' => "/home/work/hdtocs/swoole_mooc/thinkphp/swoole/swoole_mooc/public/static",
        'worker_num' => 5,

    ]

);

$http->on('WorkerStart', function(swoole_server $server,  $worker_id) {
    // 定义应用目录
    define('APP_PATH', __DIR__ . '/../application/');
    // 加载框架里面的文件
    require __DIR__ . '/../thinkphp/base.php';
    //require __DIR__ . '/../thinkphp/start.php';
});




$http->on('request', function($request, $response) use ($http){

    $_SERVER  =  [];
    if(isset($request->server)) {
        foreach($request->server as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }


    if(isset($request->header)) {
        foreach($request->header as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }


    $_GET = [];
    if(isset($request->get)) {
        foreach($request->get as $k => $v) {
            $_GET[$k] = $v;
        }
    }

    $_POST = [];
    if(isset($request->post)) {
        foreach($request->post as $k => $v) {
            $_POST[$k] = $v;
        }
    }

    ob_start();
    // 执行应用并响应
    try {
        think\Container::get('app', [APP_PATH])
            ->run()
            ->send();
    }catch (\Exception $e) {
        // todo
    }

    $res = ob_get_contents();
    ob_end_clean();

    //$response->cookie("singwa", "xsssss", time() + 1800);
    $response->end($res);
});

$http->start();