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
namespace ConfidencesTest\ZendIntercom\Asset;

use Confidences\ZendIntercom\Listener\Javascript;

class JavascriptListener extends Javascript
{
    public function getListeners()
    {
        return $this->listeners;
    }
}
