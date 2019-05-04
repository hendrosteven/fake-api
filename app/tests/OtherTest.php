<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

$f3 = Base::instance();
$f3->config('config/config.ini');

class OtherTest extends TestCase{
    private $productSvr;
    private $product;
 
    protected function setUp(){
        //$this->productSvr = new ProductService();
    }
 
    protected function tearDown(){
        //$this->productSvr = NULL;
        //$this->product = NULL;
    }
 
    public function testService(){
       
        $data = false;
        $this->assertEquals(true, $data);
    }
}