# craft-feedback-form plugin for Craft CMS 3.x

Allow the user to submit feedback to be sent to a list of email addresses configured in the plugin

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require nzmebooks/feedback-form

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for feedback-form.

## Configuring feedback-form

You'll want to check the settings to configure:

* **Modal Text**: text that will displayed in the modal to the user
(e.g. 'any feedback you can give helps us focus on what you need.')

* **To Email**: The email address(es) that the contact form will send to. Separate multiple email addresses with commas.

* **Sender Text**: Text that will be prepended to the email’s From Name to inform who the Feedback Form actually was sent by.
(e.g. 'On behalf of')

* **Subject Text**: Text that will be prepended to the email’s Subject to flag that it comes from the Feedback Form.
(e.g. 'New feedback')

* **Honeypot Field**: The name of the "honeypot" field in your Feedback Form.
(e.g. 'name')

* **Success Flash Message**: The flash message displayed after successfully sending a message.
(e.g. 'Your feedback has been sent!')

## Using feedback-form

You'll need a form that looks somewhat like the following:

    <form id="feedback-form" class="feedback-form" action="" method="POST" data-abide="ajax">
        {{ csrfInput() }}
        <input type="hidden" name="action" value="feedback-form/send-message">

        {# Our honeypot field #}
        <input type="input" name="name" style="border: none;">

        <div class="field-line">
            <label class="modal__label">Comments
                <textarea class="modal__message" name="feedback" rows="5" required ></textarea>
            </label>
        </div>

        <input class="modal__button button radius" type="submit" name="submit" value="Send Feedback"/>

    </form>

Brought to you by [meBooks](https://mebooks.co.nz)
