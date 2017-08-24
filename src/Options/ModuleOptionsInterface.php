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
namespace Confidences\ZendIntercom\Options;

/**
 * @codeCoverageIgnore
 */
interface ModuleOptionsInterface
{
    /**
     * @return string $appId
     */
    public function getAppId();

    /**
     * @return string $accessToken
     */
    public function getAccessToken();

    /**
     * @return string $identityVerificationSecret
     */
    public function getIdentityVerificationSecret();

    /**
     * @return bool $enableJavascriptIntegration
     */
    public function getEnableJavascriptIntegration();

    /**
     * @return array $excludedRoutes
     */
    public function getExcludedRoutes();

    /**
     * @return string $zendIntercomAuthIdentityIdMethod
     */
    public function getZendIntercomAuthIdentityIdMethod();

    /**
     * @return string $zendIntercomAuthIdentityEmailMethod
     */
    public function getZendIntercomAuthIdentityEmailMethod();
}
