<?php
namespace ConfidencesTest\ZendIntercom\Factory;

use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Zend\Mvc\Controller\PluginManager;
use Confidences\ZendIntercom\Controller\Plugin\Intercom;

class IntercomControllerPluginFactoryTest extends \PHPUnit_Framework_TestCase
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
