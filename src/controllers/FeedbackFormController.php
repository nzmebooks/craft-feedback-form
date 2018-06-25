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
class FeedbackFormController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['send-message'];

    // Public Methods
    // =========================================================================

    /**
     * Sends an email based on the posted params.
     *
     * @throws Exception
     */
    public function actionSendMessage()
    {
        $this->requirePostRequest();

        $settings = FeedbackForm::$plugin->getSettings();

        $message = new FeedbackFormModel();
        $savedBody = false;

        $message->feedback = Craft::$app->getRequest()->getBodyParam('feedback');

        if (!$message->validate()) {
            // Something has gone horribly wrong.
            if (Craft::$app->getRequest()->isAjaxRequest()) {
                return $this->returnErrorJson($message->getErrors());
            }
            else {
                $message = 'There was a problem with your submission, please check the form and try again!';
                Craft::$app->getSession()->setError($message);

                if ($savedBody !== false) {
                    $message->message = $savedBody;
                }

                Craft::$app->getUrlManager()->setRouteVariables([
                    'message' => $message
                ]);
            }
        }

        // Only actually send it if the honeypot test was valid
        if ($this->validateHoneypot($settings->honeypotField)) {
            if (EventHelper::$plugin->feedbackformService->sendMessage($message)) {
                if (Craft::$app->getRequest()->isAjaxRequest()) {
                    $this->returnJson(array(
                        'success' => true,
                        'message' => $settings->successFlashMessage
                    ));
                }
                else {
                    // Deprecated. Use 'redirect' instead.
                    $successRedirectUrl = Craft::$app->getRequest()->getBodyParam('successRedirectUrl');

                    if ($successRedirectUrl) {
                        $_POST['redirect'] = $successRedirectUrl;
                    }

                    Craft::$app->getSession()->setNotice($settings->successFlashMessage);
                    $this->redirectToPostedUrl($message);
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

        $honey = Craft::$app->getRequest()->getPost($fieldName);

        return $honey == '';
    }
}
