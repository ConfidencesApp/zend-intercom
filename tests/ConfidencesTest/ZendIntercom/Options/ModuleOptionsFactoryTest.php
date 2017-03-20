<?php

namespace ConfidencesTest\ZendIntercom\Options;

use ConfidencesTest\ZendIntercom\Util\ServiceManagerFactory;
use Confidences\ZendIntercom\Options\ModuleOptions as Options;
use Confidences\ZendIntercom\Options\ModuleOptionsFactory as OptionsFactory;

class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Confidences\ZendIntercom\Options\ModuleOptions::__invoke
     */
    public function testFactory()
    {
        $serviceManager = ServiceManagerFactory::getServiceManager();
        $optionsFactory = new OptionsFactory();
        $this->assertInstanceOf(Options::class, $optionsFactory->__invoke($serviceManager, Options::class));
    }
}
