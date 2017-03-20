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
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Confidences\ZendIntercom\Options\ModuleOptions;
use Zend\Authentication\AuthenticationServiceInterface;

class Module implements
    AutoloaderProviderInterface,
    BootstrapListenerInterface,
    ConfigProviderInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $options = $sm->get(ModuleOptions::class);
        
        if ($options->getEnableJavascriptIntegration()) {
            $excludedRoutes = $options->getExcludedRoutes();
            if (count($excludedRoutes)) {
                $em = $e->getApplication()->getEventManager();
                $em->attach(
                    MvcEvent::EVENT_DISPATCH,
                    function ($dispatchEvent) use ($excludedRoutes, $sm) {
                        if (!in_array($dispatchEvent->getRouteMatch()->getMatchedRouteName(), $excludedRoutes)) {
                            $this->setupJavascriptLogging($sm);
                        }
                    }
                );
            } else {
                $this->setupJavascriptLogging($sm);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return [
            AutoloaderFactory::STANDARD_AUTOLOADER => [
                StandardAutoloader::LOAD_NS => [
                    __NAMESPACE__ => __DIR__ . '/src/',
                ]
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    /**
     * Adds the necessary javascript, tries to prepend
     *
     * @param MvcEvent $event
     */
    protected function setupJavascriptLogging($sm)
    {
        $options = $sm->get(ModuleOptions::class);
        $authService = $sm->get('zend_intercom_auth_service');
        
        if ($authService instanceof AuthenticationServiceInterface && $authService->hasIdentity()) {
            $idMethod = $options->getZendIntercomAuthIdentityIdMethod();
            $emailMethod = $options->getZendIntercomAuthIdentityEmailMethod();
            $identity = $authService->getIdentity();
            
            $viewHelper = $sm->get('ViewHelperManager')->get('headscript');
            $viewHelper->appendScript(sprintf('window.intercomSettings = {user_id: "%s",email: "%s",app_id: "%s"};', $identity->$idMethod(), $identity->$emailMethod(), $options->getAppId()));
            $viewHelper->appendScript(sprintf("(function(){var w=window;var ic=w.Intercom;if(typeof ic===\"function\"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/%s';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()", $options->getAppId()));
        }
    }
}
