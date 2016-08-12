<?php

namespace Ivanhoe\SDK;

interface HttpClientInterface
{

    public function setOpts(array $opts);

    public function getContent($url, array $request = array());

}