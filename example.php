<?php
require_once "vendor/autoload.php";

$httpClient = new \Ivanhoe\SDK\CurlClient();
$sessionResource = new \Ivanhoe\SDK\SessionResource($httpClient);

try {
    $subId = $sessionResource->setCredentials([
        '11473673099', // developer id
        'eyJpdiI6IjFPM2ZBOVc5V1FETGV1dE9YblJPaHc9PSIsInZhbHVlIjoiZTREQyt4ZFwvS0VJYXJSV01YWGtDQlNlNzhXWFJnY1JkY3dsVmFWdHhQRDg9IiwibWFjIjoiNGQyODQ2MzEwMmQ5MDdkNzczNTdkYzM5Njc0ZDJmNDY2OGVmYWZkMDg0MmU3YTQ1NjY2NWY1YmIzMDVlZGMxNyJ9'  // password
    ])
        ->getSubId([
            // your website hostname
            'hostname'         => 'http://test.com',
            // google analytics profile id
            // https://developers.google.com/analytics/devguides/collection/analyticsjs/cookies-user-id
            'google_client_id' => Ivanhoe\SDK\Analytics::getProfileId(),
        ]);
} catch (\Ivanhoe\SDK\AnalyticsException $e) {
    die($e->getMessage());
}


var_dump($subId);