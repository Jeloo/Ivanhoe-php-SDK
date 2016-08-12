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
`hostname` - Your website hostname.

`user_agent` - Valid user agent.

`user_ip` - Valid ipv4 or ipv6.  

`referrer` - The traffic source.  

`document_path`.    

`language` - Two characters that means a user language.    

Example: 

-----------
``` php
$httpClient = new \Ivanhoe\SDK\CurlClient();
$sessionResource = new Ivanhoe\SDK\SessionResource($httpClient);

$subId = $sessionResource->setCredentials(['id', 'password'])
    ->getSubId([
        'hostname'   => 'http://test.com',
        'user_agent' => 'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
        'user_ip'    => '127.0.0.1'
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
