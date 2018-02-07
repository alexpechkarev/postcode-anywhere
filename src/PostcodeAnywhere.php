<?php namespace PostcodeAnywhere;

/**
 * Description of PostcodeAnywhere
 *
 * @author Alexander Pechkarev
 */
class PostcodeAnywhere
{


    /*
    |--------------------------------------------------------------------------
    | Parameters
    |--------------------------------------------------------------------------
    | Service key - required
    | The key to use to authenticate to the service
    | String  - AA11-AA11-AA11-AA11
    |
    | Postcode - required
    | The postcode to search with find.
    |
    |--------------------------------------------------------------------------
    | Bank account validation parameters
    |--------------------------------------------------------------------------
    | Sortcode - Required
    |
    */
    private $params;

    /*
    |--------------------------------------------------------------------------
    | Request data
    |--------------------------------------------------------------------------
    | Holds request data
    */
    private $request = [];

    /*
    |--------------------------------------------------------------------------
    | Web service URL
    |--------------------------------------------------------------------------
    */
    private $url;


    /*
    |--------------------------------------------------------------------------
    | Array of available services
    |--------------------------------------------------------------------------
    */
    private $services;

    /*
    |--------------------------------------------------------------------------
    | Service Url
    |--------------------------------------------------------------------------
    */
    private $serviceUrl;

    /*
    |--------------------------------------------------------------------------
    | Request type
    |--------------------------------------------------------------------------
    |
    | find - get data for given postcode
    | retrieve - get full address data for give postcode ID
    */
    private $requestType;


    /*
    |--------------------------------------------------------------------------
    | Request end point
    |--------------------------------------------------------------------------
    |
    */
    private $requestEndPoint;


    /*
    |--------------------------------------------------------------------------
    | Available end points
    |--------------------------------------------------------------------------
    |
    */
    private $endPoints;


    /*
    |--------------------------------------------------------------------------
    | Request URL
    |--------------------------------------------------------------------------
    |
    | final service URL with parameters build in
    */
    private $requestUrl;


    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->validateConfig();
    }

    /**
     * Validate configuration file
     * @throws \ErrorException
     */
    protected function validateConfig()
    {
        // Check for config file
        if (!\Config::has('postcodeanywhere')) {
            throw new \ErrorException('Unable to find PostcodeAnywhere config file.');
        }
        // Read config file
        $config = \Config::get('postcodeanywhere', []);

        // Validate Key parameter
        if (!array_key_exists('params', $config)
            || !array_key_exists('key', $config['params'])
            || empty($config['params']['key'])) {
            throw new \ErrorException('Postcode Anywhere Key must be set in config file.');
        }

        // Validate Key parameter
        if (
            !array_key_exists('url', $config) ||
            !is_array($config['url']) ||
            count($config['url']) < 1
        ) {
            throw new \ErrorException('Web service URL is not set in config file.');
        }

        // Validate Service URL parameters
        if (
            !array_key_exists('services', $config) ||
            !is_array($config['services']) ||
            count($config['services']) < 1
        ) {
            throw new \ErrorException('Service URLs must be set in config file');
        }


        // Validate Endpoint
        if (
            !array_key_exists('endpoint', $config) ||
            !is_array($config['endpoint']) ||
            count($config['endpoint']) < 1
        ) {
            throw new \ErrorException('End point must be set in config file');
        }


        // Assisgn values
        $this->params = $config['params'];
        $this->url = $config['url'];
        $this->services = $config['services'];
        $this->endPoints = $config['endpoint'];

    }
    /***/


    /**
     * Set single parameter
     * @param string $key
     * @param string $value
     */
    public function setParam($key, $value)
    {

        if (array_key_exists($key, $this->params)) {
            $this->params[$key] = $value;
        }
    }
    /***/


    /**
     * Build request string, make call and return response
     * find - type of request [find, retrieve]
     * param - array of required parameters for PA web service
     *  - endpoint - type of reponse, default json, [json, csv, xml ...]
     *
     * return \PA::getResponse(['find' =>'FindByPostcode','param'=>['postcode' => 'SW1A 1AA', 'endpoint' => 'json'] ])
     * @param array $param - ['find' => ['postcode'=>'SW1A 1AA', 'endpoing'=> 'json'] ]
     * @return object
     */
    public function getResponse($param = [])
    {

        if (empty($param)) {

            throw new \ErrorException('No parameters are given.');
        }

        // determin request type find or retrieve
        $this->setRequestType(array_keys($param));

        // set web service url as per config file
        $this->setServiceUrl($param[$this->requestType]);

        if (!array_key_exists('param', $param)) {

            throw new \ErrorException('Request parameters must be given.');
        }

        // set endpoing and build url params
        $this->setAlParams($this->setEndPoint($param['param']));

        return $this->makeRequest();
    }
    /***/

    /**
     * Set request type find or retrieve
     * @param array $action
     * @throws \ErrorException
     */
    protected function setRequestType($action)
    {

        if (!in_array('find', $action)
            && !in_array('retrieve', $action)) {
            throw new \ErrorException('One of the following parameters "find" or "retrieve" must be provided.');
        }

        //determin request type find or retrieve
        $this->requestType = in_array('retrieve', $action) ? 'retrieve' : 'find';
    }
    /***/

    /**
     * Setting Web Service URL
     * @param string $serviceUrl
     * @throws \ErrorException
     */
    protected function setServiceUrl($serviceUrl)
    {

        if (!array_key_exists($serviceUrl, $this->services[$this->requestType])) {

            throw new \ErrorException('Web service ' . $serviceUrl . ' has no URL defined in config file.');
        }

        $this->serviceUrl = $this->services[$this->requestType][$serviceUrl];
    }
    /***/

    /**
     * Set End Point
     * @param array $param
     * @return array
     */
    protected function setEndPoint($param)
    {

        //default end point
        $this->requestEndPoint = 'json.ws?';

        //determin end point
        if (array_key_exists('endpoint', $param)) {

            // is given endpoint correct
            $this->requestEndPoint = array_key_exists($param['endpoint'], $this->endPoints)
                ? $this->endPoints[$param['endpoint']]
                : 'json.ws?';

            unset($param['endpoint']);
        }

        return $param;
    }
    /***/

    /**
     * Assign all parameters at once
     * @param type $params
     */
    protected function setAlParams($params)
    {

        if (is_array($params)) {

            $this->params = array_merge($this->params, $params);
        }
    }
    /***/

    /**
     * Build request data
     *  - request type must be set
     *  - parameters must be set
     *
     * @return type
     */
    protected function buildRequest()
    {
        $this->request = [];
        foreach ($this->params as $key => $val) {
            // ommit parameters with empty values
            if (!empty($val)) {
                $this->request[] = $key . '=' . urlencode($val);
            }
        }

        $this->requestUrl = $this->url . $this->serviceUrl . $this->requestEndPoint;


        $this->requestUrl .= implode('&', $this->request);

    }
    /***/

    /**
     * Make request
     * @return object
     */
    protected function makeRequest()
    {

        /**
         *  building requst URL with parameters
         *  - request type must be set
         *  - parameters must be set
         */
        $this->buildRequest();

        $ch = curl_init($this->requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        if ($output === false) {
            throw new \ErrorException(curl_error($ch));
        }


        curl_close($ch);

        return $output;

    }
    /***/


}

