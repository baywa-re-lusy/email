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

namespace BayWaReLusy\EmailTools\Adapter;

use BayWaReLusy\EmailTools\EmailAttachment;

/**
 * EmailAdapterInterface
 *
 * @package     BayWaReLusy
 * @subpackage  EmailTools
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
     * @param EmailAttachment[] $attachments
     */
    public function sendMessage(array $to, string $subject, string $message, array $attachments = []): void;
}
