<?php
/**
 * 统一访问入口
 */
// $origin = $_SERVER['HTTP_HOST'];
// $methods = 'GET, POST, PUT, DELETE, OPTIONS';
// $credentials = 'true';
// $headers = 'Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With, Authorization, token, Accept, Cookie';
// if ('OPTIONS' === $_SERVER['REQUEST_METHOD']) {
//     header("Access-Control-Allow-Origin:{$origin}");
//     header("Access-Control-Allow-Methods:{$methods}");
//     header("Access-Control-Allow-Credentials:{$credentials}");
//     header("Access-Control-Allow-Headers:{$headers}");
//     header('HTTP/1.1 204 No Content');
//     exit();
// }
// header("Access-Control-Allow-Origin:{$origin}");
// header("Access-Control-Allow-Methods:{$methods}");
// header("Access-Control-Allow-Credentials:{$credentials}");
// header("Access-Control-Allow-Headers:{$headers}");

require_once dirname(__FILE__) . '/init.php';

$pai = new \PhalApi\PhalApi();
$pai->response()->output();
