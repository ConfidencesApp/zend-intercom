<?php
namespace ConfidencesTest\ZendIntercom\Listener;

use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Intercom\IntercomClient;
use Confidences\ZendIntercom\Listener\Javascript;
use Zend\Authentication\AuthenticationServiceInterface;
use ConfidencesTest\ZendIntercom\Asset\JavascriptListener;
use Confidences\ZendIntercom\Options\ModuleOptions;
use Confidences\ZendIntercom\Factory\JavascriptFactory;
use Zend\EventManager\EventManager;
use Zend\EventManager\SharedEventManager;
use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;
use ConfidencesTest\ZendIntercom\Asset\Identity;
use Zend\Router\RouteMatch;

class JavascriptFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $sm;
    protected $listener;
    
    public function setUp()
    {
        $this->sm = ServiceManagerFactory::getServiceManager();
        $this->sm->setAllowOverride(true);
        
        $authServiceMock = $this->getMockBuilder(AuthenticationServiceInterface::class)->getMock();
        $authServiceMock->method('hasIdentity')->will($this->returnValue(true));
        $authServiceMock->method('getIdentity')->will($this->returnValue(new Identity()));
        
        $this->sm->setService('fake_auth_service', $authServiceMock);
        $this->sm->setAlias('zend_intercom_auth_service', 'fake_auth_service');
        
        $this->sm->setAllowOverride(false);
        
        $this->listener = (new JavascriptFactory())->__invoke($this->sm, JavascriptListener::class);
    }
    
    public function testJavascriptListenerCanAttachEvents()
    {
        $this->listener->attach(new EventManager(new SharedEventManager()));
        $this->assertEquals(1, count($this->listener->getListeners()));
    }
    
    public function testJavascriptListenerCanDetachEvents()
    {
        $em = new EventManager();
        $this->listener->attach($em);
        $this->listener->detach($em);
        $this->assertEquals(0, count($this->listener->getListeners()));
    }
    
    public function testJavascriptListenerCanInjectJavascript()
    {
        $em = new EventManager();
        $this->listener->attach($em);
        
        $em->triggerEvent((new MvcEvent(MvcEvent::EVENT_RENDER))
            ->setRouteMatch((new RouteMatch([]))->setMatchedRouteName('displayable-route')));
        
        $javascriptScriptCount = count($this->sm->get('ViewHelperManager')->get('HeadScript')->getContainer());
        $this->assertEquals(2, $javascriptScriptCount);
    }
    
    public function testJavascriptListenerDoNotInjectJavascriptOnNotFoundRoute()
    {
        $em = new EventManager();
        $this->listener->attach($em);
    
        $em->triggerEvent(new MvcEvent(MvcEvent::EVENT_RENDER));
    
        $javascriptScriptCount = count($this->sm->get('ViewHelperManager')->get('HeadScript')->getContainer());
        $this->assertEquals(0, $javascriptScriptCount);
    }
    
    public function testJavascriptListenerCannotInjectJavascriptOnExcludedRoute()
    {
        $em = new EventManager();
        $this->listener->attach($em);
    
        $em->triggerEvent((new MvcEvent(MvcEvent::EVENT_RENDER))
            ->setRouteMatch((new RouteMatch([]))->setMatchedRouteName('undisplayable-route')));
    
        $javascriptScriptCount = count($this->sm->get('ViewHelperManager')->get('HeadScript')->getContainer());
        $this->assertEquals(0, $javascriptScriptCount);
    }
}
