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

namespace BayWaReLusy\Tools\Queue;

use BayWaReLusy\EmailTools\Adapter\EmailAdapterInterface;

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
    protected EmailAdapterInterface $adapter;

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
     * Return the adapter.
     *
     * @return EmailAdapterInterface
     */
    public function getAdapter(): EmailAdapterInterface
    {
        return $this->adapter;
    }
}
