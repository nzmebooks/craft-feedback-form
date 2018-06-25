<?php
/**
 * feedback-form plugin for Craft CMS 3.x
 *
 * Allow the user to submit feedback to be sent to a list of email addresses configured in the plugin
 *
 * @link      https://mebooks.co.nz
 * @copyright Copyright (c) 2018 meBooks
 */

namespace nzmebooks\feedbackform\services;

use nzmebooks\feedbackform\Feedbackform;

use Craft;
use craft\base\Component;

/**
 * @author    meBooks
 * @package   Feedbackform
 * @since     1.0.0
 */
class FeedbackFormService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (Feedbackform::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
