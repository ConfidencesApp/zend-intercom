<?php
use Confidences\ZendIntercom\Factory\IntercomServiceFactory;
use Confidences\ZendIntercom\Factory\IntercomControllerPluginFactory;
use Confidences\ZendIntercom\Options\ModuleOptions;
use Confidences\ZendIntercom\Factory\ModuleOptionsFactory;
use Confidences\ZendIntercom\Listener\Javascript;
use Confidences\ZendIntercom\Factory\JavascriptFactory;

return [
    'zend-intercom' => [
        'app_id' => null,
        'access_token' => null,
        'identity_verification_secret' => null,
        'enable_javascript_integration' => false,
        'excluded_routes' => [],
        'zend_intercom_auth_identity_id_method' => 'getId',
        'zend_intercom_auth_identity_email_method' => 'getEmail'
    ],
    'service_manager' => [
        'factories' => [
            ModuleOptions::class => ModuleOptionsFactory::class,
            Javascript::class => JavascriptFactory::class,
            'intercom' => IntercomServiceFactory::class
        ],
        'aliases' => [
            'zend_intercom_auth_service' => 'zfcuser_auth_service'
        ]
    ],
    'controller_plugins' => [
        'factories' => [
            'intercom' => IntercomControllerPluginFactory::class
        ]
    ]
];