<?php
namespace ConfidencesTest\ZendIntercom\Service;

use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Intercom\IntercomClient;

class IntercomServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryCreatesIntercomService()
    {
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $intercomService = $serviceManager->get('intercom');
        $this->assertInstanceOf(IntercomClient::class, $intercomService);
    }
}
