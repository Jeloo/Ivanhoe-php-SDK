<?php

namespace Ivanhoe\SDK;

class SessionResource implements SessionResourceInterface
{

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $password;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param array $credentials
     * @return $this
     */
    public function setCredentials(array $credentials)
    {
        $this->secretKey = $credentials[0];
        $this->password = $credentials[1];
        return $this;
    }

    /**
     * @param array $body
     * @return mixed|null
     */
    public function getSubId(array $body = array())
    {
        if (!$this->secretKey || !$this->password) {
            throw new \LogicException('Credentials should be set first');
        }

        $this->httpClient->setOpts(array(
            CURLOPT_USERPWD => $this->secretKey . ":" . $this->password
        ));

        return $this->httpClient->getContent($this->getUrl(), array(
            'body' => array_merge($body, $this->userInfo())
        ));
    }

    /**
     * Returns array of items with user info that will be
     * added to request body
     *
     * @return array
     */
    protected function userInfo()
    {
        if (PHP_SAPI === 'cli') {
            return array();
        }

        return array(
            'hostname'      => $_SERVER['SERVER_NAME'],
            'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
            'referrer'      => $_SERVER['HTTP_REFERER'],
            'user_ip'       => $_SERVER['REMOTE_ADDR'],
            'language'      => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'document_path' => $_SERVER['PATH_INFO'],
        );
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return sprintf(
            '%s/v%s/%s',
            Settings::API_BASE_URL,
            Settings::API_VERSION,
            Settings::API_SESSION_PATH
        );
    }

}