<?php 

    use PHPUnit\Framework\TestCase;

    final class StackTest extends TestCase
    {
        private $configFile;

        public function setUp() : void {
            $this->configFile = 'config/app.json';
        }

        public function testConfigFileExists() : void {

            $this->assertTrue( file_exists($this->configFile) );
        }

        public function testConfigFileIsValid() : void {

            $config = json_decode(file_get_contents($this->configFile), true);

            $this->assertTrue( is_array($config) );
            $this->assertTrue( array_key_exists("default", $config) );
            $this->assertTrue( array_key_exists("conn", $config) );
            $this->assertTrue( array_key_exists("mysqli", $config["conn"]) );
            $this->assertTrue( array_key_exists("host", $config["conn"]["mysqli"]) );
        }


    }
