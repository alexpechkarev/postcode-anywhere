<?php namespace PostcodeAnywhere\php;

/**
 * PostcodeAnywhere API Wrapper for Laravel
 * Test file
 *
 * @author Alexander Pechkarev
 */
class PostcodeAnywhere {

    
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
    |
    */     
    public $params ;
    
    /*
    |--------------------------------------------------------------------------
    | Request data
    |--------------------------------------------------------------------------
    | Holds request data
    */    
    public $request = []; 
    
    /*
    |--------------------------------------------------------------------------
    | Web service URL
    |--------------------------------------------------------------------------
    */     
    public $url;    
    
    
    /*
    |--------------------------------------------------------------------------
    | Array of available services
    |--------------------------------------------------------------------------
    */     
    public $services;      
    
    /*
    |--------------------------------------------------------------------------
    | Service Url
    |--------------------------------------------------------------------------
    */     
    public $serviceUrl;
    
     
    
    /*
    |--------------------------------------------------------------------------
    | Request type
    |--------------------------------------------------------------------------
    | 
    | find - get data for given postcode 
    | retrive - get full address data for give postcode ID
    */     
    public $requestType;
    
    
    /*
    |--------------------------------------------------------------------------
    | Request end point
    |--------------------------------------------------------------------------
    | 
    */     
    public $requestEndPoint;    
    
    
    /*
    |--------------------------------------------------------------------------
    | Available end points
    |--------------------------------------------------------------------------
    | 
    */     
    public $endPoints;      
     
    
    
    /*
    |--------------------------------------------------------------------------
    | Request URL
    |--------------------------------------------------------------------------
    | 
    | final service URL with parameters build in
    */     
    public $requestUrl;    
    
    
    
    /*
    |--------------------------------------------------------------------------
    | Config file
    |--------------------------------------------------------------------------
    | 
    */     
    public $config;      

    
   
    /**
     * Class constructor
     */
    public function __construct($config = [])
      {
        $this->config = $config;
        $this->validateConfig();
      }
      /***/

    /**
     * Validate configuration file
     * @throws \ErrorException
     */ 
    protected function validateConfig(){
            
            // Validate Key parameter
            if(!array_key_exists('params', $this->config)
                    || !array_key_exists('key', $this->config['params'])
                    || empty( $this->config['params']['key'])){
                throw new \ErrorException('Postcode Anywhere Key must be set in config file.');
            }
            
            // Validate Key parameter
            if(!array_key_exists('url', $this->config)
                    || empty( $this->config['url'])){
                throw new \ErrorException('Web service URL is not set in config file.');
            }            
            
            // Validate Service URL parameters
            if(!array_key_exists('services', $this->config)
                    || !count($this->config['services'] < 1)){
                throw new \ErrorException('Service URLs must be set in config file');
            }   
            
            
            // Validate Endpoint
            if(!array_key_exists('endpoint', $this->config)
                    || !count($this->config['endpoint'] < 1)){
                throw new \ErrorException('End point must be set in config file');
            }  
             
            
            // Assisgn values
            $this->params           = $this->config['params'];
            $this->url              = $this->config['url'];
            $this->services         = $this->config['services'];
            $this->endPoints        = $this->config['endpoint'];          
                    
    }
    /***/
      
    
    /**
     * Set single parameter
     * @param string $key
     * @param string $value
     */
    public function setParam($key, $value){
  
        if( array_key_exists($key, $this->params) ){
            $this->params[$key] = $value;
        }
    }
    /***/
    

    
    /**
     * Build request string, make call and return response
     * find - type of request [find, retrive]
     * param - array of required parameters for PA web service
     *  - endpoint - type of reponse, default json, [json, csv, xml ...]
     * 
     * return \PA::getRespose(['find' =>'FindByPostcode','param'=>['postcode' => 'SW1A 1AA', 'endpoint' => 'json'] ])
     * @param array $param - ['find' => ['postcode'=>'SW1A 1AA', 'endpoing'=> 'json'] ]
     * @return object
     */
    public function getRespose($param = []){
        
        if( empty( $param ) ){
            
            throw new \ErrorException('No parameters are given.');
        }        

       // determin request type find or retrive 
       $this->setRequestType(array_keys($param));
       
       // set web service url as per config file
       $this->setServiceUrl( $param[$this->requestType] );

        if( !array_key_exists('param',$param) ){
            
            throw new \ErrorException('Request parameters must be given.');
        }
        
        // set endpoing and build url params
        $this->setAlParams( $this->setEndPoint($param['param']) );
                
        return $this->makeRequest();
    }
    /***/
    
    /**
     * Set request type find or retrive
     * @param array $action
     * @throws \ErrorException
     */
    public function setRequestType( $action ){
        
        if( !in_array('find', $action)
                && !in_array('retrieve', $action)){
            throw new \ErrorException('One of the following parameters "find" or "retrieve" must be provided.');
        }
        
        //determin request type find or retrive
        $this->requestType = in_array('retrieve', $action) ? 'retrieve' : 'find';        
    }
    /***/
    
    /**
     * Setting Web Service URL
     * @param string $serviceUrl
     * @throws \ErrorException
     */
    public function setServiceUrl($serviceUrl){
        
        if( !array_key_exists($serviceUrl, $this->services[ $this->requestType]) ){

            throw new \ErrorException('Web service '.$serviceUrl.' has no URL defined in config file.');            
        }
        
        $this->serviceUrl = $this->services[ $this->requestType ][ $serviceUrl ];
    }
    /***/
    
    /**
     * Set End Point
     * @param array $param
     * @return array
     */
    public function setEndPoint($param){
        
        //default end point
        $this->requestEndPoint = 'json';
        
        //determin end point
        if(array_key_exists('endpoint', $param) ){
            
            // is given endpoint correct
            $this->requestEndPoint = array_key_exists($param['endpoint'], $this->endPoints)
                                        ? $this->endPoints[$param['endpoint']]
                                        : 'json';
            
            unset($param['endpoint']);
        } 
        
        return $param;
    }
    /***/
    
    /**
     * Assign all parameters at once
     * @param type $params
     */
    public function setAlParams($params){
        
        if(is_array($params) ){
            
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
    public function buildRequest(){

        foreach($this->params as $key=>$val)
        {   
                // ommit parameters with empty values
                if( !empty( $val )){
                    $this->request[] = $key . '=' .urlencode($val);
                }
        }
        
        $this->requestUrl = $this->url.$this->serviceUrl.$this->requestEndPoint;
        
        
        $this->requestUrl.= implode('&',$this->request);
        
    }
    /***/
    
    /**
     * Make request
     * @return object
     */
    public function makeRequest(){
        
       /**
         *  building requst URL with parameters
         *  - request type must be set
         *  - parameters must be set
         */
        $this->buildRequest();        
      
       $ch = curl_init( $this->requestUrl );
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       $output = curl_exec($ch);
       
      if( $output === false ){
          throw new \ErrorException( curl_error($ch) );
      }


      curl_close($ch);
      return $output;       

    }
    /***/

    
}

