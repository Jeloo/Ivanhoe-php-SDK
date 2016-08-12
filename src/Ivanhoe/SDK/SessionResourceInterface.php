<?php

namespace Ivanhoe\SDK;

/**
 * Interface SessionResourceInterface
 * @package Ivanhoe\SDK
 */
interface SessionResourceInterface
{
    /**
     * @param array $credentials
     * @return $this
     */
    public function setCredentials(array $credentials);

    /**
     * @return string|null
     */
    public function getSubId();
}