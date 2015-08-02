<?php

class PATest extends PHPUnit_Framework_TestCase {
        


    protected $app;
    
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function __construct()
    {
            #$this->app = require __DIR__.'/../bootstrap/app.php';

            #$this->app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
//            if ( ! $this->app)
//            {
//                    $this->refreshApplication();
//            }
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
//            if ($this->app)
//            {
//                    $this->app->flush();
//            }
    }    
    
    
    
    /**
     * Can class be instantiated
     */
    public function testInstance(){
        
        $this->assertTrue(TUE);
//        $inst = new \PostcodeAnywhere\PostcodeAnywhere();
//
//        $this->assertInstanceOf('\PostcodeAnywhere\PostcodeAnywhere', $inst);
    }
    /***/
               

}
