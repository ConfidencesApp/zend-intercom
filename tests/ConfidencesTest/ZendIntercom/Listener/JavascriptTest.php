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
        $this->buildServices(1, 'john.doe@example.com');
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

    /**
     * @dataProvider userDataProvider
     */
    public function testGenerateSettings($userId, $userEmail, $expectedHash)
    {
        $this->buildServices($userId, $userEmail);
        $listener = (new JavascriptFactory())->__invoke($this->sm, JavascriptListener::class);

        $settings = $this->invokeMethod($listener, 'generateSettings');

        if ($userId !== null) {
            $this->assertArrayHasKey('user_id', $settings);
        }
        if ($userEmail !== null) {
            $this->assertArrayHasKey('email', $settings);
        }
        if ($userId !== null || $userEmail !== null) {
            $this->assertArrayHasKey('user_hash', $settings);
        }
    }

    /**
     * @dataProvider userDataProvider
     */
    public function testGenerateUserHash($userId, $userEmail, $expectedHash)
    {
        $this->assertEquals(
            $expectedHash,
            $this->invokeMethod($this->listener, 'generateUserHash', array($userId, $userEmail))
        );
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    protected function buildServices($userId = null, $userEmail = null)
    {
        $this->sm = ServiceManagerFactory::getServiceManager();
        $this->sm->setAllowOverride(true);

        $authServiceMock = $this->getMockBuilder(AuthenticationServiceInterface::class)->getMock();
        $authServiceMock->method('hasIdentity')->will($this->returnValue(true));
        $authServiceMock->method('getIdentity')->will($this->returnValue(new Identity($userId, $userEmail)));

        $this->sm->setService('fake_auth_service', $authServiceMock);
        $this->sm->setAlias('zend_intercom_auth_service', 'fake_auth_service');

        $this->sm->setAllowOverride(false);
    }

    public function userDataProvider()
    {
        return [
            [null, null, null],
            [1, null, 'cb2688ec7c4eb2b86107a57ea43d5dca20a5955cc20bc6ec87ff894aa2bf809c'],
            [null, 'john.doe@example.com', '5415216e80279b95f632768174bf355689b791f1633f53e639ccc905dde3a72b'],
            [1, 'john.doe@example.com', 'cb2688ec7c4eb2b86107a57ea43d5dca20a5955cc20bc6ec87ff894aa2bf809c']
        ];
    }
}
