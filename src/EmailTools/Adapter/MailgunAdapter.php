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

    /**
     * @param string $apiKey Mailgun API Key
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    protected function getMailgunClient(): Mailgun
    {
        return Mailgun::create($this->apiKey, 'https://api.eu.mailgun.net');
    }
}
