<?php

/**
 * EmailService.php
 *
 * @date      13.10.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      EmailService.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\Email;

use BayWaReLusy\Email\Adapter\EmailAdapterInterface;
use Exception;

/**
 * Class EmailService
 *
 * @package     BayWaReLusy
 * @subpackage  Email
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class EmailService
{
    private string $subjectPrefix = '';

    /**
     * @param EmailAdapterInterface $adapter
     */
    public function __construct(protected EmailAdapterInterface $adapter)
    {
    }

    /**
     * Sets an additional subject prefix to mark staging/testing environments for example
     * @param string $subjectPrefix
     * @return void
     */
    public function setSubjectPrefix(string $subjectPrefix): void
    {
        $this->subjectPrefix = $subjectPrefix;
    }


    /**
     * Send a message.
     *
     * @param string[] $to
     * @param string $subject
     * @param string $message
     * @param string | null $template
     * @param string[] $variables
     * @param EmailAttachment[] $attachments
     * @param string[] $cc
     * @param bool $sendAsHtml
     * @throws Exception
     * @throws EmailException
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
        $this->adapter->sendMessage($to, $this->subjectPrefix . $subject, $message, $template, $variables, $attachments, $cc, $sendAsHtml);
    }
}
