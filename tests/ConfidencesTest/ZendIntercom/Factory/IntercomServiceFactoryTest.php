<?php
namespace ConfidencesTest\ZendIntercom\Service;

use PHPUnit_Framework_TestCase as TestCase;
use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Intercom\IntercomClient;

class IntercomServiceFactoryTest extends TestCase
{
    public function testFactoryCreatesIntercomService()
    {
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $intercomService = $serviceManager->get('intercom');
        $this->assertInstanceOf(IntercomClient::class, $intercomService);
    }
}
