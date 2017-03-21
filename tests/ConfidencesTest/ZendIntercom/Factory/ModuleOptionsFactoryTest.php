<?php
namespace ConfidencesTest\ZendIntercom\Factory;

use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Intercom\IntercomClient;
use Confidences\ZendIntercom\Listener\Javascript;
use Confidences\ZendIntercom\Options\ModuleOptions;

class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryCreatesJavascriptListener()
    {
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $intercomService = $serviceManager->get(ModuleOptions::class);
        $this->assertInstanceOf(ModuleOptions::class, $intercomService);
    }
}
