# Confidences ZendIntercom

[![Build Status](https://travis-ci.org/ConfidencesApp/zend-intercom.svg?branch=master)](https://travis-ci.org/ConfidencesApp/zend-intercom)
[![Latest Stable Version](https://poser.pugx.org/ConfidencesApp/zend-intercom/v/stable)](https://packagist.org/packages/ConfidencesApp/zend-intercom)
[![License](https://poser.pugx.org/ConfidencesApp/zend-intercom/license.svg)](https://packagist.org/packages/ConfidencesApp/zend-intercom)
[![Code Coverage](https://coveralls.io/repos/ConfidencesApp/zend-intercom/badge.svg?branch=master)](https://coveralls.io/r/ConfidencesApp/zend-intercom?branch=master)

A Zend Framework 3 module that lets you to use the Intercom service.

#Installation

This module is available on [Github](https://github.com/ConfidencesApp/zend-intercom).
In your project's `composer.json` use:

    {   
        "require": {
            "confidencesapp/zend-intercom": "dev-master"
    }
    
Run `php composer.phar update` to download it into your vendor folder and setup autoloading.

Now copy `zend-intercom.local.php.dist` to `yourapp/config/autoload/zend-intercom.local.php` and add your Intercom Acces Token and App ID.

Add `Confidences\ZendIntercom` to the modules array in your `application.config.php`, preferably as the first module. 

That's it. There's nothing more you need to do, everything works at that stage.
