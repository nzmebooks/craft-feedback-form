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
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $modalText = 'We\re keen to hear any feedback you might have about our site';

    /**
     * @var string
     */
    public $toEmail;

    /**
     * @var string
     */
    public $prependSender = 'On behalf of';

    /**
     * @var string
     */
    public $prependSubject = 'New feedback';

    /**
     * @var string
     */
    public $honeypotField = 'name';

    /**
     * @var string
     */
    public $successFlashMessage = 'Your feedback has been sent.';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['toEmail', 'successFlashMessage'], 'required'],
        ];
    }
}
