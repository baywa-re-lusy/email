<?php

/**
 * MailgunAdapter.php
 *
 * @date      16.02.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      MailgunAdapter.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\EmailTools\Adapter;

use BayWaReLusy\EmailTools\EmailException;
use Mailgun\Mailgun;

/**
 * MailgunAdapter
 *
 * @package    BayWaReLusy
 * @author     Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright  Copyright (c) BayWa r.e. - All rights reserved
 * @license    Unauthorized copying of this source code, via any medium is strictly
 *             prohibited, proprietary and confidential.
 */
class MailgunAdapter implements EmailAdapterInterface
{
    protected string $apiKey;
    protected string $domain;
    protected string $endpoint;
    protected ?Mailgun $mailgunClient = null;

    /**
     * @param string $apiKey Mailgun API Key
     * @param string $domain Mailgun Domain
     * @param string $endpoint Mailgun Endpoint
     */
    public function __construct(string $apiKey, string $domain, string $endpoint)
    {
        $this->apiKey   = $apiKey;
        $this->domain   = $domain;
        $this->endpoint = $endpoint;
    }

    protected function getMailgunClient(): Mailgun
    {
        if (!$this->mailgunClient) {
            $this->mailgunClient = Mailgun::create($this->apiKey, $this->endpoint);
        }
        return $this->mailgunClient;
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
            $email =
                [
                    'from'    => 'no-reply@' . $this->domain,
                    'to'      => $to,
                    'subject' => $subject,
                ];

            if ($sendAsHtml && $template == null) {
                $email['html'] = $message;
            } elseif ($template !== null) {
                $email['template'] = $template;
                if ($variables) {
                    $email['h:X-Mailgun-Variables'] = json_encode($variables);
                }
            } else {
                $email['text'] = $message;
            }
            if (!empty($cc)) {
                $email['cc'] = $cc;
            }

            $mailgunAttachments = [];
            foreach ($attachments as $attachment) {
                $mailgunAttachments[] =
                    [
                        'fileContent' => $attachment->getData(),
                        'filename'    => $attachment->getFilename()
                    ];
            }

            if (!empty($mailgunAttachments)) {
                $email['attachment'] = $mailgunAttachments;
            }
            $this->getMailgunClient()->messages()->send($this->domain, $email);
        } catch (\Throwable $e) {
            throw new EmailException("Email couldn't be sent.");
        }
    }
}
