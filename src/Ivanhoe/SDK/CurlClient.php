<?php

namespace Ivanhoe\SDK;

class CurlClient implements HttpClientInterface
{

    /**
     * @var array
     */
    private $curlOpts = array();

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
     * @param $url
     * @param array $request
     * @return mixed|null
     * @throws HttpException
     */
    public function getContent($url, array $request = array())
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

        $content = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($statusCode !== 200) {
            throw new HttpException(
                'Got an error response trying to get sub id. Status code: ' . $statusCode
            );
        }

        curl_close($ch);

        if ($content === false) {
            $content = null;
        }

        return $content;
    }

}