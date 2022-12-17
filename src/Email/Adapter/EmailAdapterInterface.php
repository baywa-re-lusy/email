<?php

/**
 * EmailAdapterInterface.php
 *
 * @date      13.10.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      EmailAdapterInterface.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\Email\Adapter;

use BayWaReLusy\Email\EmailAttachment;
use BayWaReLusy\Email\EmailException;

/**
 * EmailAdapterInterface
 *
 * @package     BayWaReLusy
 * @subpackage  Email
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface EmailAdapterInterface
{
    /**
     * Send a message with the given parameters.
     *
     * @param string[] $to
     * @param string $subject
     * @param string $message
     * @param string | null $template
     * @param string[] $variables
     * @param EmailAttachment[] $attachments
     * @param string[] $cc
     * @param bool $sendAsHtml
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
    ): void;
}
