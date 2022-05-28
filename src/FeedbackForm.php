<?php
/**
 * feedback-form plugin for Craft CMS 3.x
 *
 * Allow the user to submit feedback to be sent to a list of email addresses configured in the plugin
 *
 * @link      https://mebooks.co.nz
 * @copyright Copyright (c) 2018 meBooks
 */

namespace nzmebooks\feedbackform;

use nzmebooks\feedbackform\services\SendMessageService;
use nzmebooks\feedbackform\variables\FeedbackFormVariable;
use nzmebooks\feedbackform\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class Feedbackform
 *
 * @author    meBooks
 * @package   Feedbackform
 * @since     1.0.0
 *
 * @property  FeedbackFormService $feedbackFormService
 */
class FeedbackForm extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var FeedbackForm
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register Components (Services)
        $this->setComponents([
            'sendMessageService' => SendMessageService::class,
        ]);

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('feedbackform', FeedbackFormVariable::class);
            }
        );
    }

    public function getName()
    {
        return $this->name;
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?\craft\base\Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate(
            'feedback-form/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
