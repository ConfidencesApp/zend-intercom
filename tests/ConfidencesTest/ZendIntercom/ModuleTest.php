<?php
namespace ConfidencesTest\ZendIntercom;

use Confidences\ZendIntercom\Module;
use Zend\Loader;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testModuleProvidesConfig()
    {
        $module = new Module;
        $config = $module->getConfig();

        $this->assertEquals('array', gettype($config));
    }

    public function testModuleAutoloader()
    {
        $module   = new Module;
        $actual   = $module->getAutoloaderConfig();
        $expected = array(
            Loader\AutoloaderFactory::STANDARD_AUTOLOADER => array(
                Loader\StandardAutoloader::LOAD_NS => array(
                    'Confidences\ZendIntercom' => realpath(__DIR__ . '/../../../src') . '/',
                ),
            ),
        );
        $this->assertEquals($expected, $actual);
    }
}
