<?php
/**
 * Confidences ZendIntercom
 *
 * This source file is part of the Confidences ZendIntercom package
 *
 * @package    Confidences\ZendIntercom\Controller\Plugin\Intercom
 * @license    Apache 2 {@link /LICENSE}
 * @copyright  Copyright (c) 2017, Confidences
 */
namespace Confidences\ZendIntercom\Controller\Plugin;

use Intercom\IntercomClient;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Intercom controller plugin as proxy to the Intercom service
 */
class Intercom extends AbstractPlugin
{
    /**
     * @var IntercomClient
     */
    protected $service;

    /**
     * Constructor
     *
     * @param  IntercomClient $service
     * @return \ZendIntercom\Intercom
     */
    public function __construct(IntercomClient $service)
    {
        $this->service = $service;
    }

    /**
     * Invoke Intercom service
     *
     * @return \Intercom\IntercomClient
     */
    public function __invoke()
    {
        return $this->getService();
    }

    /**
     * Get the Intercom service class
     *
     * @return IntercomClient
     */
    protected function getService()
    {
        return $this->service;
    }
}
