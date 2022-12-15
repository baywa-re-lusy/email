<?php

/**
 * SendgridAdapter.php
 *
 * @date      15.12.2022
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      SendgridAdapter.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\Email\Adapter;

use BayWaReLusy\Email\EmailException;
use SendGrid;
use SendGrid\Mail\Mail;

/**
 * SendgridAdapter
 *
 * @package    BayWaReLusy
 * @author     Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright  Copyright (c) BayWa r.e. - All rights reserved
 * @license    Unauthorized copying of this source code, via any medium is strictly
 *             prohibited, proprietary and confidential.
 */
class SendgridAdapter implements EmailAdapterInterface
{
    protected ?SendGrid $sendgridClient = null;

    /**
     * @param string $apiKey
     * @param string $domain
     */
    public function __construct(
        protected string $apiKey,
        protected string $domain
    ) {
    }

    protected function getSendgridClient(): SendGrid
    {
        if (!$this->sendgridClient) {
            $this->sendgridClient = new SendGrid($this->apiKey);
        }

        return $this->sendgridClient;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage(
        array $to,
        string $subject,
        string $message,
        ?string $template = null,
        array $variables = [],
        array $attachments = [],
        array $cc = [],
        bool $sendAsHtml = false
    ): void {
        try {
            $email = new Mail();
            $email->setFrom('no-reply@' . $this->domain);
            $email->setSubject($subject);

            foreach ($to as $recipient) {
                $email->addTo($recipient);
            }

            foreach ($cc as $recipient) {
                $email->addCc($recipient);
            }

            $sendAsHtml ?
                $email->addContent('text/html', $message):
                $email->addContent('text/plain', $message);

            $this->sendgridClient->send($email);
        } catch (\Throwable $e) {
            error_log($e->getMessage());
            error_log($e->getTraceAsString());
            throw new EmailException("Email couldn't be sent.");
        }
    }
}
