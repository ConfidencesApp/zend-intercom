<?php
use Confidences\ZendIntercom\Factory\IntercomServiceFactory;
use Confidences\ZendIntercom\Factory\IntercomControllerPluginFactory;

return array(
	'zend-intercom' => array(
		'api_id' => null,
		'access_token' => null
	),
	'service_manager' => array(
		'factories' => array(
			'intercom' => IntercomServiceFactory::class
		)
	),
    'controller_plugins' => array(
        'factories' => array(
            'intercom' => IntercomControllerPluginFactory::class,
        ),
    ),
);