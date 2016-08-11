<?php

namespace Ivanhoe\SDK;

interface HttpClientInterface
{
    public function setCredentials(array $credentials);

    public function getSubId();
}