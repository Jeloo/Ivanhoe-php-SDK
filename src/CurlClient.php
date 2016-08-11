<?php

namespace Ivanhoe\SDK;

class CurlClient implements HttpClientInterface
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
     * @var array
     */
    private $curlOpts;

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

        return $this->getContent($body);
    }

    /**
     * @param array $curlOpts
     * @return $this
     */
    public function setOpts(array $curlOpts)
    {
        $this->curlOpts = $curlOpts;
        return $this;
    }

    /**
     * @param array $body
     * @return mixed|null
     */
    protected function getContent(array $body = array())
    {
        $body = array_merge($body, $this->userInfo());;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        curl_setopt($ch, CURLOPT_USERPWD, $this->secretKey . ":" . $this->password);

        foreach ($this->curlOpts as $opt => $value) {
            curl_setopt($ch, $opt, $value);
        }

        $content = curl_exec($ch);
        curl_close($ch);

        if ($content === false) {
            $content = null;
        }

        return $content;
    }

    /**
     * Returns array of items with user info that will be
     * added to request body
     *
     * @return array
     */
    protected function userInfo()
    {
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