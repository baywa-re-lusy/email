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
    protected ?Mailgun $mailgunClient = null;

    /**
     * @param string $apiKey Mailgun API Key
     * @param string $domain Mailgun Domain
     */
    public function __construct(string $apiKey, string $domain)
    {
        $this->apiKey = $apiKey;
        $this->domain = $domain;
    }

    protected function getMailgunClient(): Mailgun
    {
        if (!$this->mailgunClient) {
            $this->mailgunClient = Mailgun::create($this->apiKey, 'https://api.eu.mailgun.net');
        }
        return $this->mailgunClient;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage(array $to, string $subject, string $message): void
    {
        $this->getMailgunClient()->messages()->send(
            $this->domain,
            [
                'from'    => 'no-reply@' . $this->domain,
                'to'      => $to,
                'subject' => $subject,
                'text'    => $message,
            ]
        );
    }
}
