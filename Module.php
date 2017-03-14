<?php
/**
 * Confidences ZendIntercom
 *
 * This source file is part of the Confidences ZendIntercom package
 *
 * @package    Confidences\ZendIntercom
 * @license    Apache 2 {@link /LICENSE}
 * @copyright  Copyright (c) 2017, Confidences
 */
namespace Confidences\ZendIntercom;

use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    
    /* (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     */
    public function getAutoloaderConfig()
    {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__ . '/src/',
                ),
            ),
        );
    }

    /* (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\ConfigProviderInterface::getConfig()
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
