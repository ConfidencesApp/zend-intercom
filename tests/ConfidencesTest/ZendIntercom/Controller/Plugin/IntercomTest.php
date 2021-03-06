<?php
namespace ConfidencesTest\ZendIntercom\Controller\Plugin;

use Confidences\ZendIntercom\Controller\Plugin\Intercom;
use Intercom\IntercomClient;

class IntercomTest extends \PHPUnit_Framework_TestCase
{
    protected $service;
    protected $plugin;

    public function setUp()
    {
        $this->service = new IntercomClient(null, null);
        $this->plugin = new Intercom($this->service);
    }

    public function testInvokingPluginProxiesToService()
    {
        $plugin = $this->plugin;
        $this->assertInstanceOf(IntercomClient::class, $plugin());
    }
}
