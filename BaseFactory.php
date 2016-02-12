<?php

namespace emilebons\moneybird;

class BaseFactory
{
    /**
     * @var string the identifier of the administration to use, e.g. 123
     */
    protected $administrationId;
    /**
     * @var string the api base url, e.g. "https://moneybird.com/api/"
     */
    protected $apiBaseUrl = "https://moneybird.com/api/";
    /**
     * @var string the api sub url, e.g. "sales_invoices"
     */
    protected $apiSubUrl;
    /**
     * @var string the API token, i.e. "84ec207ad0154a508f798e615a998ac1fd752926d00f955fb1df3e144cba44ab"
     */
    protected $apiToken;
    /**
     * @var MoneyBirdClient the client to be used for connecting to MoneyBird
     */
    protected $client;
    /**
     * @var ConverterInterface the converter to use for parsing and converting
     */
    protected $converter;
    /**
     * @var string the version of the API to be used, at the moment MoneyBird only supports v2
     */
    protected $version = "v2";

    /**
     * @param string $administrationId the identifier of the administration to which we connect
     * @param null|MoneyBirdClient $client the client to use, if null, the default MoneyBirdClient will be used
     * @param null|string $apiToken the API token, if null, no API token will be used (in the case this is not needed
     * for the client provided)
     */
    public function __construct($administrationId, $client = null, $apiToken = null)
    {
        $this->administrationId = $administrationId;
        $this->client = is_null($client) ? new MoneyBirdClient($apiToken) : $client;
        $this->client->apiBaseUrl = $this->apiBaseUrl.'/'.$this->version.'/'.$this->administrationId;
        $this->apiToken = $apiToken;
    }

    /**
     * The filter argument allows you to filter on the list of invoices. Filters are a combination of keys and values,
     * separated by a comma: key:value,key2:value2. The most common filter method will be period: period:this_month.
     * Filtering works the same as in the web application, for more advanced examples, change the filtering in the web
     * application and learn from the resulting URI.
     * @param array $filter the filters with their key as key and their value as value
     * @return string the filter formatted as a string, e.g. "key:value,key2:value2"
     */
    private function createFilter($filter = array())
    {
        $stringFilter = [];
        foreach($filter as $key => $value)
        {
            $stringFilter[] = "$key:$value";
        }
        return implode(',', $stringFilter);
    }

    /**
     * @param array $filter the filter to use, e.g. ['period' => 'this_month']
     * @return array the list of objects retrieved
     */
    public function listAll($filter = array())
    {
        $params = $filter ? array('filter' => $this->createFilter($filter)) : array();
        $response = $this->client->api($this->apiSubUrl.'.json', 'GET', $params);
        $objects = [];
        foreach($response as $array)
        {
            $objects[] = $this->converter->parse($array);
        }
        return $objects;
    }

}