<?php


class PATest extends PHPUnit_Framework_TestCase {

    
    protected $config;
    
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function __construct()
    {
        $this->config = include(__DIR__.'/../src/config/postcodeanywhere.php');
        
    }


    
    
    /**
     * Can class be instantiated
     */
    public function testInstance(){
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( $this->config );
        $this->assertInstanceOf('\PostcodeAnywhere\php\PostcodeAnywhere', $pa);
    }
    /***/
    
     /**
     * @expectedException ErrorException
     */
    public function testConfigException()
    {
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( [] );

    } 
    
     /**
     * @expectedException ErrorException
     */
    public function testParamsException()
    {
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( ['params' =>[] ] );

    } 
    
     /**
     * @expectedException ErrorException
     */
    public function testParamsKeyException()
    {
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( ['params' =>['key' => ''] ] );
    } 
    
     /**
     * @expectedException ErrorException
     */
    public function testUrlException()
    {
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( ['url' => ''] );
    } 
    
     /**
     * @expectedException ErrorException
     */
    public function testServicesException()
    {
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( ['services' => ''] );
    } 
    
     /**
     * @expectedException ErrorException
     */
    public function testEndpointsException()
    {

        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( ['endpoints' => ''] );
    } 
       
    
    
    public function testArrayHasKey(){
        
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( $this->config );
        $this->assertNull($pa->serviceUrl);
        
    }
    
    
    public function testSetRequestType(){
        
        $pa = new \PostcodeAnywhere\php\PostcodeAnywhere( $this->config );
        
        $pa->setRequestType([0 =>'find']);
        $this->assertEquals('find', $pa->requestType);
        
        $pa->setRequestType([0 => 'retrieve']);
        $this->assertEquals('retrieve', $pa->requestType); 
        
    }
               

}
