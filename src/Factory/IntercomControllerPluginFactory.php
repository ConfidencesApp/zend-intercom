<?php
/**
 * Confidences ZendIntercom
 *
 * This source file is part of the Confidences ZendIntercom package
 *
 * @package    Confidences\ZendIntercom\Factory\IntercomServiceFactory
 * @license    Apache 2 {@link /LICENSE}
 * @copyright  Copyright (c) 2017, Confidences
 */
namespace Confidences\ZendIntercom\Factory;

use Confidences\ZendIntercom\Controller\Plugin\Intercom as IntercomControllerPlugin;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class IntercomControllerPluginFactory implements FactoryInterface
{
    
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = $container->get('intercom');
        return new IntercomControllerPlugin($service);
    }
}
