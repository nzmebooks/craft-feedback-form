<?php
/**
 * feedback-form plugin for Craft CMS 3.x
 *
 * Allow the user to submit feedback to be sent to a list of email addresses configured in the plugin
 *
 * @link      https://mebooks.co.nz
 * @copyright Copyright (c) 2018 meBooks
 */

namespace nzmebooks\feedbackform\controllers;

use nzmebooks\feedbackform\FeedbackForm;
use nzmebooks\feedbackform\models\FeedbackFormModel;

use Craft;
use craft\web\Controller;

/**
 * @author    meBooks
 * @package   Feedbackform
 * @since     1.0.0
 */
class SendMessageController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Sends an email based on the posted params.
     *
     * @throws Exception
     */
    public function actionIndex()
    {
        $this->requirePostRequest();

        $settings = FeedbackForm::$plugin->getSettings();

        $message = new FeedbackFormModel();
        $savedBody = false;

        $message->feedback = Craft::$app->getRequest()->getBodyParam('feedback');

        if (!$message->validate()) {
            // Something has gone horribly wrong.
            if (Craft::$app->getRequest()->getIsAjax()) {
                return $this->asErrorJson($message->getErrors());
            }
        }

        // Only actually send it if the honeypot test was valid
        if ($this->validateHoneypot($settings->honeypotField)) {
            if (FeedbackForm::$plugin->sendMessageService->sendMessage($message)) {
                if (Craft::$app->getRequest()->getIsAjax()) {
                    return $this->asJson(array(
                        'success' => true,
                        'message' => $settings->successFlashMessage
                    ));
                }
            }
        }
    }

    /**
     * Checks that the 'honeypot' field has not been filled out (assuming one has been set).
     *
     * @param string $fieldName The honeypot field name.
     * @return bool
     */
    protected function validateHoneypot($fieldName)
    {
        if (!$fieldName) {
            return true;
        }

        $honey = Craft::$app->getRequest()->getBodyParam($fieldName);

        return $honey == '';
    }
}
