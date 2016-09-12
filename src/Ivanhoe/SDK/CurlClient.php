<?php

namespace Ivanhoe\SDK;

class CurlClient implements HttpClientInterface
{

    /**
     * @var array
     */
    private $curlOpts = array();

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $responseBody;

    /**
     * @param array $opts
     * @return $this
     */
    public function setOpts(array $opts)
    {
        $this->curlOpts = $opts;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $url
     * @param array $request
     * @return bool
     */
    public function exec($url, array $request = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request['body']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        foreach ($this->curlOpts as $opt => $value) {
            curl_setopt($ch, $opt, $value);
        }

        $this->responseBody = curl_exec($ch);
        $this->statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return $this->isSuccess();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->responseBody;
    }

    /**
     * Determines if the last request is successful
     * @return bool
     */
    public function isSuccess()
    {
        return $this->statusCode == 200;
    }

}