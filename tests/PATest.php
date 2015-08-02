<?php

class PATest extends TestCase {

        /**
         * Can class be instantiated
         */
        public function testInstance(){
            $inst = new \PostcodeAnywhere\PostcodeAnywhere();
            
            $this->assertInstanceOf('\PostcodeAnywhere\PostcodeAnywhere', $inst);
        }
        /***/  

}
