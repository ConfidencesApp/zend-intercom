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

use Intercom\IntercomClient;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class IntercomServiceFactory implements FactoryInterface
{
    
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\Factory\FactoryInterface::__invoke()
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        $config = $config['zend-intercom'];
        
        $intercom = new IntercomClient($config['access_token'], null);
        return $intercom;
    }
}
