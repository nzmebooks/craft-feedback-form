<?php
/**
 * feedback-form plugin for Craft CMS 3.x
 *
 * Allow the user to submit feedback to be sent to a list of email addresses configured in the plugin
 *
 * @link      https://mebooks.co.nz
 * @copyright Copyright (c) 2018 meBooks
 */

namespace nzmebooks\feedbackform\variables;

use nzmebooks\feedbackform\FeedbackForm;

use Craft;

/**
 * @author    meBooks
 * @package   Feedbackform
 * @since     1.0.0
 */
class FeedbackFormVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @return string
     */
    public function getSettings()
    {
        return FeedbackForm::$plugin->getSettings();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return FeedbackForm::$plugin->getName();
    }
}
