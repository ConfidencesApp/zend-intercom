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
namespace Confidences\ZendIntercom\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Confidences\ZendIntercom\Options\ModuleOptionsInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\View\HelperPluginManager;

class Javascript implements ListenerAggregateInterface
{
    protected $listeners = [];
    protected $options;
    protected $authService;
    protected $viewHelperManager;
    
    public function __construct(
        ModuleOptionsInterface $options,
        AuthenticationServiceInterface $authService,
        HelperPluginManager $viewHelperManager
    ) {
        $this->options = $options;
        $this->authService = $authService;
        $this->viewHelperManager = $viewHelperManager;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            [$this, 'injectJavascriptSDK'],
            $priority
        );
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            $events->detach($listener);
            unset($this->listeners[$index]);
        }
    }
    
    public function injectJavascriptSDK(MvcEvent $e)
    {
        if ($this->options->getEnableJavascriptIntegration()) {
            $routeMatch = $e->getRouteMatch();
            if ($routeMatch === null) {
                return;
            }
            $excludedRoutes = $this->options->getExcludedRoutes();
            if (count($excludedRoutes)) {
                $matchedRouteName = $routeMatch->getMatchedRouteName();
                if (!in_array($matchedRouteName, $excludedRoutes)) {
                    $this->injectJavascriptHTML();
                }
            } else {
                $this->injectJavascriptHTML();
            }
        }
    }
    
    /**
     * Adds the necessary javascript, tries to prepend
     */
    protected function injectJavascriptHTML()
    {
        if ($this->authService->hasIdentity()) {
            $idMethod = $this->options->getZendIntercomAuthIdentityIdMethod();
            $emailMethod = $this->options->getZendIntercomAuthIdentityEmailMethod();
            $identity = $this->authService->getIdentity();
    
            $viewHelper = $this->viewHelperManager->get('HeadScript');
            $viewHelper->appendScript(
                sprintf(
                    'window.intercomSettings = {user_id: "%s",email: "%s",app_id: "%s"};',
                    $identity->$idMethod(),
                    $identity->$emailMethod(),
                    $this->options->getAppId()
                )
            );
            // @codingStandardsIgnoreStart
            $viewHelper->appendScript(
                sprintf(
                    "(function(){var w=window;var ic=w.Intercom;if(typeof ic===\"function\"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/%s';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()",
                    $this->options->getAppId()
                )
            );
            // @codingStandardsIgnoreEnd
        }
    }
}
