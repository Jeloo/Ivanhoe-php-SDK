# Ivanhoe-php-SDK

##Installation
-----------
``` sh
$ composer require ivanhoe/ivanhoe-sdk
```

## Basic Usage
### Create a user session and get sub id
-----------
``` php
$httpClient = new \Ivanhoe\SDK\CurlClient();
$sessionResource = new Ivanhoe\SDK\SessionResource($httpClient);

$subId = $sessionResource->setCredentials(['id', 'password'])
    ->getSubId();
```

This method will send user data to Ivanhoe server and return a generated sub id.
But you can pass custom body parameters to SessionResource::getSubId to override user info. 
Able parameters are: 
--------------------
`hostname` - Your website hostname with a protocol.

`user_agent` - Valid user agent.

`user_ip` - Valid ipv4 or ipv6.  

`referrer` - The traffic source.  

`document_path`.    

`language` - Two characters that means a user language.

`google_client_id` - Google analytics client id from [_ga] cookie. Can be get within a helper Analitycs

Example: 

-----------
``` php
$httpClient = new \Ivanhoe\SDK\CurlClient();
$sessionResource = new Ivanhoe\SDK\SessionResource($httpClient);

$subId = $sessionResource->setCredentials(['id', 'password'])
    ->getSubId([
        'hostname'   => 'http://test.com',
        // google analytics profile id
        // https://developers.google.com/analytics/devguides/collection/analyticsjs/cookies-user-id
        'google_client_id' => Ivanhoe\SDK\Analytics::getProfileId(),
    ]);
```

### Setting options

You are able to set curl options on CurlClient::setOpts method. The keys are curl option constants.

-----------
``` php
$httpClient = new \Ivanhoe\SDK\CurlClient();
$httpClient->setOpts([
    CURLOPT_FRESH_CONNECT => true
]);
```
