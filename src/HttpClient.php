<?php

namespace Ivanhoe\SDK;

class HttpClient implements HttpClientInterface
{
    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $password;

    public function setCredentials(array $credentials)
    {
        $this->secretKey = $credentials[0];
        $this->password = $credentials[1];
    }

    public function getSubId()
    {
        //@todo implement getSubId
    }

}