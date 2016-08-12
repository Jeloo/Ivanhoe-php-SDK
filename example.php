<?php

require_once "vendor/autoload.php";

$httpClient = new \Ivanhoe\SDK\CurlClient();
$sessionResource = new Ivanhoe\SDK\SessionResource($httpClient);

$subId = $sessionResource->setCredentials(['test', 'secret'])
    ->getSubId([
        'hostname'   => 'http://test.com',
        'user_agent' => 'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
        'user_ip'    => '127.0.0.1'
    ]);

var_dump($subId);