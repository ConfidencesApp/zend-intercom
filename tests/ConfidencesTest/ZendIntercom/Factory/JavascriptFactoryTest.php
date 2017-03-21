<?php
namespace ConfidencesTest\ZendIntercom\Factory;

use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Intercom\IntercomClient;
use Confidences\ZendIntercom\Listener\Javascript;
use Zend\Authentication\AuthenticationServiceInterface;

class JavascriptFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $sm;
    
    public function setUp()
    {
        $this->sm = ServiceManagerFactory::getServiceManager();
        $this->sm->setAllowOverride(true);
        
        $authServiceMock = $this->getMockBuilder(AuthenticationServiceInterface::class)->getMock();
        $this->sm->setService('fake_auth_service', $authServiceMock);
        $this->sm->setAlias('zend_intercom_auth_service', 'fake_auth_service');
        
        $this->sm->setAllowOverride(false);
    }
    
    public function testFactoryCreatesJavascriptListener()
    {
        $javascripListener = $this->sm->get(Javascript::class);
        $this->assertInstanceOf(Javascript::class, $javascripListener);
    }
}
