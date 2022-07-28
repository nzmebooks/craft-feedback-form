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

use nzmebooks\feedbackform\FeedbackForm;
use nzmebooks\feedbackform\models\FeedbackFormModel;

use Craft;
use craft\base\Component;
use craft\helpers\ArrayHelper;
use craft\mail\Message;

use yii\helpers\HtmlPurifier;

/**
 * @author    meBooks
 * @package   Feedbackform
 * @since     1.0.0
 */
class SendMessageService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Sends an email submitted through a feedback form.
     *
     * @param FeedbackFormModel $message
     * @throws Exception
     * @return bool
     */
    public function sendMessage(FeedbackFormModel $message)
    {
        $settings = FeedbackForm::$plugin->getSettings();

        if (!$settings->toEmail) {
            throw new Exception('The "To Email" address is not set on the plugin’s settings page.');
        }

        // Grab any "to" emails set in the plugin settings.
        $toEmails = ArrayHelper::toArray($settings->toEmail);

        foreach ($toEmails as $toEmail) {
            // construct and send the email
            // TODO: consider abstracting email functionality to a separate class, as per
            // https://github.com/vigetlabs/craft-disqusnotify/blob/master/src/services/Email.php
            $email = new Message();
            $emailSettings = Craft::$app->getProjectConfig()->get('email');

            $email->setFrom([$emailSettings['fromEmail'] => $emailSettings['fromName']]);
            $email->setTo($toEmail);

            $user = Craft::$app->getUser()->getIdentity();

            if ($user) {
                $subject = $settings->prependSubject . ' -- from: ' . $user->firstName . ' ' . $user->lastName . ' (' . $user->email . ')';
            } else {
                $subject = $settings->prependSubject . ' -- from: user unknown';
            }

            $email->setSubject($subject);

            // HTML is fine, but scripts are not.
            // http://craftcms.stackexchange.com/a/776
            $purified = HtmlPurifier::process($message->feedback);

            $email->setHtmlBody($purified);

            Craft::$app->mailer->send($email);
        }

        return true;
    }
}
