<?php
/**
 * feedback-form plugin for Craft CMS 3.x
 *
 * Allow the user to submit feedback to be sent to a list of email addresses configured in the plugin
 *
 * @link      https://mebooks.co.nz
 * @copyright Copyright (c) 2018 meBooks
 */

namespace nzmebooks\feedbackform\models;

use nzmebooks\feedbackform\FeedbackForm;

use Craft;
use craft\base\Model;

/**
 * @author    meBooks
 * @package   Feedbackform
 * @since     1.0.0
 */
class FeedbackFormModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $feedback;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['feedback', 'string'],
        ];
    }
}
