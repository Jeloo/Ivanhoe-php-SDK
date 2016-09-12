<?php

namespace Ivanhoe\SDK;

interface HttpClientInterface
{
    /**
     * @param array $opts
     * @return $this
     */
    public function setOpts(array $opts);
    /**
     * @param $url
     * @param array $request
     * @return bool
     */
    public function exec($url, array $request = array());
    /**
     * @return string
     */
    public function getContent();
    /**
     * Determines if the last request is successful
     * @return bool
     */
    public function isSuccess();
    /**
     * @return int
     */
    public function getStatusCode();

}