<?php

namespace Confidences\ZendIntercom\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    /**
     * Intercom Application ID
     * @var string
     */
    protected $appId = null;

    /**
     * Intercom Application Access Token
     * @var string
     */
    protected $accessToken = null;

    /**
     * Enable Intercom Javascript SDK
     * @var bool
     */
    protected $enableJavascriptIntegration = false;
    
    /**
     * Route Exclusion for Javascript Integration
     * @var array
     */
    protected $excludedRoutes = [];

    /**
     * Method used to get Identity ID
     * @var string
     */
    protected $zendIntercomAuthIdentityIdMethod = 'getId';

    /**
     * Method used to get Identity Email
     * @var string
     */
    protected $zendIntercomAuthIdentityEmailMethod = 'getEmail';

    /**
     * @return string $appId
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     * @return self
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * @return string $accessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return self
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return bool $enableJavascriptIntegration
     */
    public function getEnableJavascriptIntegration()
    {
        return $this->enableJavascriptIntegration;
    }

    /**
     * @param bool $enableJavascriptIntegration
     * @return self
     */
    public function setEnableJavascriptIntegration($enableJavascriptIntegration)
    {
        $this->enableJavascriptIntegration = $enableJavascriptIntegration;
        return $this;
    }

    /**
     * @return array $excludedRoutes
     */
    public function getExcludedRoutes()
    {
        return $this->excludedRoutes;
    }

    /**
     * @param array $excludedRoutes
     * @return self
     */
    public function setExcludedRoutes($excludedRoutes)
    {
        $this->excludedRoutes = $excludedRoutes;
        return $this;
    }

    /**
     * @return string $zendIntercomAuthIdentityIdMethod
     */
    public function getZendIntercomAuthIdentityIdMethod()
    {
        return $this->zendIntercomAuthIdentityIdMethod;
    }

    /**
     * @param string $zendIntercomAuthIdentityIdMethod
     * @return self
     */
    public function setZendIntercomAuthIdentityIdMethod($zendIntercomAuthIdentityIdMethod)
    {
        $this->zendIntercomAuthIdentityIdMethod = $zendIntercomAuthIdentityIdMethod;
        return $this;
    }

    /**
     * @return string $zendIntercomAuthIdentityEmailMethod
     */
    public function getZendIntercomAuthIdentityEmailMethod()
    {
        return $this->zendIntercomAuthIdentityEmailMethod;
    }

    /**
     * @param string $zendIntercomAuthIdentityEmailMethod
     * @return self
     */
    public function setZendIntercomAuthIdentityEmailMethod($zendIntercomAuthIdentityEmailMethod)
    {
        $this->zendIntercomAuthIdentityEmailMethod = $zendIntercomAuthIdentityEmailMethod;
        return $this;
    }
}
