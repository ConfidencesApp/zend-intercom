<?php
namespace ConfidencesTest\ZendIntercom\Service;

use PHPUnit_Framework_TestCase as TestCase;
use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Zend\Mvc\Controller\PluginManager;
use Confidences\ZendIntercom\Controller\Plugin\Intercom;

class IntercomControllerPluginFactoryTest extends TestCase
{
    public function testFactoryCreatesIntercomControllerPlugin()
    {
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $pluginManager = new PluginManager($serviceManager);
        
        $config = $serviceManager->get('Config');
        $factories = $config['controller_plugins']['factories'];
        $pluginManager->setFactory('intercom', $factories['intercom']);
        
        $plugin = $pluginManager->get('intercom');
        $this->assertInstanceOf(Intercom::class, $plugin);
    }
}
