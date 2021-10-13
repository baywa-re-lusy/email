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

namespace BayWaReLusy\EmailTools;

use BayWaReLusy\EmailTools\Adapter\EmailAdapterInterface;
use Exception;

/**
 * Class EmailService
 *
 * @package     BayWaReLusy
 * @subpackage  EmailTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class EmailService
{
    protected ?EmailAdapterInterface $adapter = null;

    /**
     * Set the adapter.
     *
     * @param EmailAdapterInterface $adapter
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(EmailAdapterInterface $adapter): EmailService
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Send a message.
     *
     * @param string[] $to
     * @param string $subject
     * @param string $message
     * @throws Exception
     */
    public function sendMessage(array $to, string $subject, string $message): void
    {
        if (!$this->adapter) {
            throw new Exception('Adapter not set.');
        }

        $this->adapter->sendMessage($to, $subject, $message);
    }
}
