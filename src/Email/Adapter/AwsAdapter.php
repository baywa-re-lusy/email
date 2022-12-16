<?php

/**
 * AwsAdapter.php
 *
 * @date      15.12.2022
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      AwsAdapter.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\Email\Adapter;

use Aws\Ses\SesClient;
use BayWaReLusy\Email\EmailException;

/**
 * AwsAdapter
 *
 * @package    BayWaReLusy
 * @author     Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright  Copyright (c) BayWa r.e. - All rights reserved
 * @license    Unauthorized copying of this source code, via any medium is strictly
 *             prohibited, proprietary and confidential.
 */
class AwsAdapter implements EmailAdapterInterface
{
    protected ?SesClient $sesClient = null;

    /**
     * @param string $awsKey
     * @param string $awsSecret
     * @param string $awsRegion
     * @param string $domain
     */
    public function __construct(
        protected string $awsKey,
        protected string $awsSecret,
        protected string $awsRegion,
        protected string $domain
    ) {
    }

    protected function getSesClient(): SesClient
    {
        if (!$this->sesClient) {
            $this->sesClient = new SesClient([
                'profile'     => 'default',
                'version'     => '2010-12-01',
                'region'      => $this->awsRegion,
                'credentials' =>
                    [
                        'key'    => $this->awsKey,
                        'secret' => $this->awsSecret,
                    ]
            ]);
        }
        return $this->sesClient;
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
            $this->getSesClient()->sendEmail([
                'Destination' =>
                    [
                        'ToAddresses' => $to,
                        'CcAddresses' => $cc,

                    ],
                'ReplyToAddresses' => ['no-reply@' . $this->domain],
                'Source'           => 'no-reply@' . $this->domain,
                'Message' =>
                    [
                        'Body' =>
                            [
                                $sendAsHtml ? 'Html' : 'Text' =>
                                    [
                                        'Charset' => 'UTF-8',
                                        'Data'    => $message,
                                    ],
                            ],
                        'Subject' =>
                            [
                                'Charset' => 'UTF-8',
                                'Data'    => $subject,
                            ],
                    ],
            ]);
        } catch (\Throwable $e) {
            error_log($e->getMessage());
            error_log($e->getTraceAsString());
            throw new EmailException("Email couldn't be sent.");
        }
    }
}
