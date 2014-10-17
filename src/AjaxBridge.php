<?php

namespace AjaxBridge;

/**
 * Class AjaxBridge
 *
 * Basic usage:
 * $ab = new AjaxBridge('https://twitter.com');
 * $ab->execute();
 *
 * For more information see https://github.com/someatoms/ajaxbridge
 */
class AjaxBridge
{

    /**
     * @var String The complete URL including protocol, host, port and query string
     */
    protected $url;

    /**
     * @var array
     */
    protected $response;

    /**
     * @var array Context created with stream_context_create(). Override to specify custom headers, method or content
     */
    protected $context;

    /**
     * Initialize the AjaxBridge object
     */
    public function __construct()
    {
        $this->url = $this->array_get($_POST, 'url', '');

        $this->context = stream_context_create([
            'http' => [
                'follow_location' => 0,
                'method' => $this->array_get($_POST, 'method', 'GET'),
                'header' => $this->prepareHeaders($this->array_get($_POST, 'headers', '')),
                'content' => $this->array_get($_POST, 'content', '')
            ]
        ]);
    }

    /**
     * Makes the request
     *
     * @param bool $echo If the response should be echoed
     */
    public function execute($echo = true)
    {
        header("Access-Control-Allow-Origin: *");

        $data = file_get_contents($this->url, false, $this->context);

        // $http_response_header is set by file_get_contents
        $protocolParams = explode(' ', array_shift($http_response_header));
        $this->response = [
            'protocol' => $protocolParams[0],
            'status' => intval($protocolParams[1]),
            'statusText' => $protocolParams[2],
            'headers' => $this->prepareResponseHeaders($http_response_header),
            'content' => $data
        ];

        if ($echo) {
            header('Content-Type: application/json');
            echo json_encode($this->response);
        }
    }

    /**
     * Return a json representation of the sent request and response
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    public function getContext()
    {
        return $this->context;
    }

    /**
     * Override the default resource context. It should be a valid context resource created with stream_context_create()
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    protected function prepareHeaders($headers)
    {
        if (is_string($headers)) {
            return $headers;
        } else {
            $str = '';
            foreach ($headers as $key => $val) {
                $str .= "$key: $val\r\n";
            }
            return $str;
        }
    }

    protected function prepareResponseHeaders($headers)
    {
        $arr = [];
        foreach ($headers as $header) {
            $parts = explode(': ', $header);
            if (isset($parts[1])) {
                $arr[$parts[0]] = $parts[1];
            } else {
                $arr[] = $parts[0];
            }
        }

        return $arr;
    }

    /**
     * Helper function
     *
     * @param $arr
     * @param $key
     * @param null $default
     * @return null
     */
    private function array_get($arr, $key, $default = null)
    {
        return isset($arr[$key]) ? $arr[$key] : $default;
    }


}