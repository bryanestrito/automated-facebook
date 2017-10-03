<?php

require_once 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class SampleTest extends PHPUnit_Framework_TestCase
{
    protected $webDriver;

    public function setUp()
    {
        // stand alone selenium server
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();

        $this->webDriver = RemoteWebDriver::create($host, $capabilities);
    }

    public function testHomepage()
    {
        $inputEmail = WebDriverBy::id('email');
        $inputPass = WebDriverBy::id('pass');
        $submitButton = WebDriverBy::cssSelector('input[value="Log In"]');

        $this->webDriver->get('https://facebook.com');
        $this->webDriver->findElement($inputEmail)->sendKeys('');
        $this->webDriver->findElement($inputPass)->sendKeys('');
        $this->webDriver->findElement($submitButton)->click();
        $this->webDriver->wait(1000, 1000);

    }

    public function tearDown()
    {
        $this->webDriver->quit();
    }
}
