<?php

namespace emilebons\moneybird;

use Exception;

class MoneyBirdClient
{
    const CONTENT_TYPE_JSON = 'json'; // JSON format
    const CONTENT_TYPE_URLENCODED = 'urlencoded'; // urlencoded query string, like name1=value1&name2=value2
    const CONTENT_TYPE_XML = 'xml'; // XML format
    const CONTENT_TYPE_AUTO = 'auto'; // attempts to determine format automatically

    /**
     * @var array cURL request options. Option values from this field will overwrite corresponding
     * values from [[defaultCurlOptions()]].
     */
    private $_curlOptions = [];
    /**
     * @var string API base URL.
     */
    public $apiBaseUrl;
    /**
     * @var string the API token, i.e. "84ec207ad0154a508f798e615a998ac1fd752926d00f955fb1df3e144cba44ab"
     */
    public $apiToken;

    /**
     * @param string $apiToken the API token to use
     * @throws Exception when the API token is not set
     */
    public function __construct($apiToken)
    {
        if(empty($apiToken)) {
            throw new Exception('An API token is not provided, this is required when using MoneyBirdClient');
        }
        $this->apiToken = $apiToken;
    }

    /**
     * Adds the API token authorization header to the set of headers provided
     * @param array $headers the headers already provided
     * @return array $headers the original headers with the authorization header added
     */
    protected function addAuthorizationHeader(array $headers)
    {
        $headers[] =  'Authorization: Bearer '.$this->apiToken;
        return $headers;
    }

    /**
     * Performs request to the OAuth API.
     * @param string $apiSubUrl API sub URL, which will be append to [[apiBaseUrl]], or absolute API URL.
     * @param string $method request method.
     * @param array $params request parameters.
     * @param array $headers additional request headers.
     * @return array API response
     */
    public function api($apiSubUrl, $method = 'GET', array $params = [], array $headers = [])
    {
        if (preg_match('/^https?:\\/\\//is', $apiSubUrl)) {
            $url = $apiSubUrl;
        } else {
            $url = $this->apiBaseUrl . '/' . $apiSubUrl;
        }
        return $this->apiInternal($url, $method, $params, $headers);
    }

    /**
     * @inheritdoc
     */
    protected function apiInternal($url, $method, array $params, array $headers)
    {
        return $this->sendRequest($method, $url, $params, $headers);
    }

    /**
     * Composes HTTP request CUrl options, which will be merged with the default ones.
     * @param string $method request type.
     * @param string $url request URL.
     * @param array $params request params.
     * @return array CUrl options.
     * @throws Exception on failure.
     */
    protected function composeRequestCurlOptions($method, $url, array $params)
    {
        $curlOptions = [];
        switch ($method) {
            case 'GET': {
                $curlOptions[CURLOPT_URL] = $this->composeUrl($url, $params);
                break;
            }
            case 'POST': {
                $curlOptions[CURLOPT_POST] = true;
                $curlOptions[CURLOPT_HTTPHEADER] = ['Content-type: application/x-www-form-urlencoded'];
                $curlOptions[CURLOPT_POSTFIELDS] = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
                break;
            }
            case 'HEAD': {
                $curlOptions[CURLOPT_CUSTOMREQUEST] = $method;
                if (!empty($params)) {
                    $curlOptions[CURLOPT_URL] = $this->composeUrl($url, $params);
                }
                break;
            }
            default: {
                $curlOptions[CURLOPT_CUSTOMREQUEST] = $method;
                if (!empty($params)) {
                    $curlOptions[CURLOPT_POSTFIELDS] = $params;
                }
            }
        }

        return $curlOptions;
    }

    /**
     * Composes URL from base URL and GET params.
     * @param string $url base URL.
     * @param array $params GET params.
     * @return string composed URL.
     */
    protected function composeUrl($url, array $params = [])
    {
        if (strpos($url, '?') === false) {
            $url .= '?';
        } else {
            $url .= '&';
        }
        $url .= http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        return $url;
    }

    /**
     * Converts XML document to array.
     * @param string|\SimpleXMLElement $xml xml to process.
     * @return array XML array representation.
     */
    protected function convertXmlToArray($xml)
    {
        if (!is_object($xml)) {
            $xml = simplexml_load_string($xml);
        }
        $result = (array) $xml;
        foreach ($result as $key => $value) {
            if (is_object($value)) {
                $result[$key] = $this->convertXmlToArray($value);
            }
        }
        return $result;
    }

    /**
     * Returns default cURL options.
     * @return array cURL options.
     */
    protected function defaultCurlOptions()
    {
        return [
            CURLOPT_USERAGENT => 'MoneyBirdClient',
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
        ];
    }

    /**
     * Attempts to determine HTTP request content type by headers.
     * @param array $headers request headers.
     * @return string content type.
     */
    protected function determineContentTypeByHeaders(array $headers)
    {
        if (isset($headers['content_type'])) {
            if (stripos($headers['content_type'], 'json') !== false) {
                return self::CONTENT_TYPE_JSON;
            }
            if (stripos($headers['content_type'], 'urlencoded') !== false) {
                return self::CONTENT_TYPE_URLENCODED;
            }
            if (stripos($headers['content_type'], 'xml') !== false) {
                return self::CONTENT_TYPE_XML;
            }
        }
        return self::CONTENT_TYPE_AUTO;
    }

    /**
     * Attempts to determine the content type from raw content.
     * @param string $rawContent raw response content.
     * @return string response type.
     */
    protected function determineContentTypeByRaw($rawContent)
    {
        if (preg_match('/^\\{.*\\}$/is', $rawContent)) {
            return self::CONTENT_TYPE_JSON;
        }
        if (preg_match('/^[^=|^&]+=[^=|^&]+(&[^=|^&]+=[^=|^&]+)*$/is', $rawContent)) {
            return self::CONTENT_TYPE_URLENCODED;
        }
        if (preg_match('/^<.*>$/is', $rawContent)) {
            return self::CONTENT_TYPE_XML;
        }
        return self::CONTENT_TYPE_AUTO;
    }

    /**
     * @return array cURL options.
     */
    public function getCurlOptions()
    {
        return $this->_curlOptions;
    }

    /**
     * @param array $curlOptions cURL options.
     */
    public function setCurlOptions(array $curlOptions)
    {
        $this->_curlOptions = $curlOptions;
    }

    /**
     * Merge CUrl options.
     * If each options array has an element with the same key value, the latter
     * will overwrite the former.
     * @param array $options1 options to be merged to.
     * @param array $options2 options to be merged from. You can specify additional
     * arrays via third argument, fourth argument etc.
     * @return array merged options (the original options are not changed.)
     */
    protected function mergeCurlOptions($options1, $options2)
    {
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            $next = array_shift($args);
            foreach ($next as $k => $v) {
                if (is_array($v) && !empty($res[$k]) && is_array($res[$k])) {
                    $res[$k] = array_merge($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }
        return $res;
    }

    /**
     * Processes raw response converting it to actual data.
     * @param string $rawResponse raw response.
     * @param string $contentType response content type.
     * @throws Exception on failure.
     * @return array actual response.
     */
    protected function processResponse($rawResponse, $contentType = self::CONTENT_TYPE_AUTO)
    {
        if (empty($rawResponse)) {
            return [];
        }
        switch ($contentType) {
            case self::CONTENT_TYPE_AUTO: {
                $contentType = $this->determineContentTypeByRaw($rawResponse);
                if ($contentType == self::CONTENT_TYPE_AUTO) {
                    throw new Exception('Unable to determine response content type automatically.');
                }
                $response = $this->processResponse($rawResponse, $contentType);
                break;
            }
            case self::CONTENT_TYPE_JSON: {
                $response = json_decode((string) $rawResponse, true);
                break;
            }
            case self::CONTENT_TYPE_URLENCODED: {
                $response = [];
                parse_str($rawResponse, $response);
                break;
            }
            case self::CONTENT_TYPE_XML: {
                $response = $this->convertXmlToArray($rawResponse);
                break;
            }
            default: {
                throw new Exception('Unknown response type "' . $contentType . '".');
            }
        }
        return $response;
    }

    /**
     * Sends HTTP request.
     * @param string $method request type.
     * @param string $url request URL.
     * @param array $params request params.
     * @param array $headers additional request headers.
     * @return array response.
     * @throws Exception on failure.
     */
    protected function sendRequest($method, $url, array $params = [], array $headers = [])
    {
        $curlOptions = $this->mergeCurlOptions(
            $this->defaultCurlOptions(),
            $this->getCurlOptions(),
            [
                CURLOPT_HTTPHEADER => $this->addAuthorizationHeader($headers),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => $url,
            ],
            $this->composeRequestCurlOptions(strtoupper($method), $url, $params)
        );
        $curlResource = curl_init();
        foreach ($curlOptions as $option => $value) {
            curl_setopt($curlResource, $option, $value);
        }

        $response = curl_exec($curlResource);
        $responseHeaders = curl_getinfo($curlResource);

        // check cURL error
        $errorNumber = curl_errno($curlResource);
        $errorMessage = curl_error($curlResource);

        curl_close($curlResource);

        if($errorNumber > 0) {
            throw new Exception('Curl error requesting "'. $url.'": #'.$errorNumber.' - '.$errorMessage);
        }
        if(strncmp($responseHeaders['http_code'], '20', 2) !== 0) {
            throw new Exception('Request failed with code: '.$responseHeaders['http_code'].', message: '.$response);
        }

        return $this->processResponse($response, $this->determineContentTypeByHeaders($responseHeaders));
    }


    /**
     * Autoloader
     *
     * To use, include spl_autoload_register('moneybird\MoneyBirdClient::autoload');
     * @static
     * @param string $className
     */
    static public function autoload($className)
    {
        if (strpos($className, __NAMESPACE__) === 0) {
            $className = substr($className, strlen(__NAMESPACE__) + 1);
            if (file_exists(__DIR__ . '/' . str_replace('\\', '/', $className) . '.php')) {
                require_once __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
            }
        }
    }
}