<?php

use Pongtan\Services\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testConfig()
    {
        $key = "test_key";
        $value = "test_value";
        Config::set($key,$value);
        $this->assertEquals($value,Config::get($key));
    }
    
}