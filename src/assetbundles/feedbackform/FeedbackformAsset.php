<?php
/**
 * feedback-form plugin for Craft CMS 3.x
 *
 * Allow the user to submit feedback to be sent to a list of email addresses configured in the plugin
 *
 * @link      https://mebooks.co.nz
 * @copyright Copyright (c) 2018 meBooks
 */

namespace nzmebooks\feedbackform\assetbundles\Feedbackform;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    meBooks
 * @package   Feedbackform
 * @since     1.0.0
 */
class FeedbackformAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@nzmebooks/feedbackform/assetbundles/feedbackform/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Feedbackform.js',
        ];

        $this->css = [
            'css/Feedbackform.css',
        ];

        parent::init();
    }
}
