<?php
/**
 * EmailToolsConfig.php
 *
 * @date        13.10.2021
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file        EmailToolsConfig.php
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\EmailTools;

/**
 * Class EmailToolsConfig
 *
 * Config object for EmailTools
 *
 * @package     BayWaReLusy
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class EmailToolsConfig
{
    protected string $mailgunApiKey;
    protected string $mailgunDomain;

    /**
     * @param string $mailgunApiKey
     * @param string $mailgunDomain
     */
    public function __construct(string $mailgunApiKey, string $mailgunDomain)
    {
        $this->mailgunApiKey = $mailgunApiKey;
        $this->mailgunDomain = $mailgunDomain;
    }

    /**
     * @return string
     */
    public function getMailgunApiKey(): string
    {
        return $this->mailgunApiKey;
    }

    /**
     * @return string
     */
    public function getMailgunDomain(): string
    {
        return $this->mailgunDomain;
    }
}
