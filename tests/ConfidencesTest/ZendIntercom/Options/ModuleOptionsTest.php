<?php

namespace ConfidencesTest\ZendIntercom\Options;

use Confidences\ZendIntercom\Options\ModuleOptions as Options;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Options $options
     */
    protected $options;

    public function setUp()
    {
        $options = new Options;
        $this->options = $options;
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getAppId
     */
    public function testGetAppId()
    {
        $this->assertEquals(null, $this->options->getAppId());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::setAppId
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getAppId
     */
    public function testSetAppId()
    {
        $this->options->setAppId('MyAppId');
        $this->assertEquals('MyAppId', $this->options->getAppId());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getAccessToken
     */
    public function testGetAccessToken()
    {
        $this->assertEquals(null, $this->options->getAccessToken());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getAccessToken
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::setAccessToken
     */
    public function testSetAccessToken()
    {
        $this->options->setAccessToken('MyAppAccessToken');
        $this->assertEquals('MyAppAccessToken', $this->options->getAccessToken());
    }

    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getIdentityVerificationSecret
     */
    public function testGetIdentityVerificationSecret()
    {
        $this->assertEquals(null, $this->options->getIdentityVerificationSecret());
    }

    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getIdentityVerificationSecret
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::setIdentityVerificationSecret
     */
    public function testSetIdentityVerificationSecret()
    {
        $this->options->setIdentityVerificationSecret('MyAppIdentityVerificationSecret');
        $this->assertEquals('MyAppIdentityVerificationSecret', $this->options->getIdentityVerificationSecret());
    }

    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getEnableJavascriptIntegration
     */
    public function testGetEnableJavascriptIntegration()
    {
        $this->assertFalse($this->options->getEnableJavascriptIntegration());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getEnableJavascriptIntegration
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::setEnableJavascriptIntegration
     */
    public function testSetEnableJavascriptIntegration()
    {
        $this->options->setEnableJavascriptIntegration(true);
        $this->assertTrue($this->options->getEnableJavascriptIntegration());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getExcludedRoutes
     */
    public function testGetExcludedRoutes()
    {
        $this->assertEquals([], $this->options->getExcludedRoutes());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getExcludedRoutes
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::setExcludedRoutes
     */
    public function testSetExcludedRoutes()
    {
        $this->options->setExcludedRoutes(['route', 'route']);
        $this->assertEquals(['route', 'route'], $this->options->getExcludedRoutes());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getZendIntercomAuthIdentityIdMethod
     */
    public function testGetZendIntercomAuthIdentityIdMethod()
    {
        $this->assertEquals('getId', $this->options->getZendIntercomAuthIdentityIdMethod());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getZendIntercomAuthIdentityIdMethod
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::setZendIntercomAuthIdentityIdMethod
     */
    public function testSetZendIntercomAuthIdentityIdMethod()
    {
        $this->options->setZendIntercomAuthIdentityIdMethod('getUuid');
        $this->assertEquals('getUuid', $this->options->getZendIntercomAuthIdentityIdMethod());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getZendIntercomAuthIdentityEmailMethod
     */
    public function testGetZendIntercomAuthIdentityEmailMethod()
    {
        $this->assertEquals('getEmail', $this->options->getZendIntercomAuthIdentityEmailMethod());
    }
    
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::getZendIntercomAuthIdentityEmailMethod
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::setZendIntercomAuthIdentityEmailMethod
     */
    public function testSetZendIntercomAuthIdentityEmailMethod()
    {
        $this->options->setZendIntercomAuthIdentityEmailMethod('getEmailAddress');
        $this->assertEquals('getEmailAddress', $this->options->getZendIntercomAuthIdentityEmailMethod());
    }
}
