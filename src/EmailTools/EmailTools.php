<?php

/**
 * EmailTools.php
 *
 * @date        13.10.2021
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file        EmailTools.php
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\EmailTools;

use Laminas\ServiceManager\ServiceManager;

/**
 * Class EmailTools
 *
 * Entry-point to use the tool-set
 *
 * @package     BayWaReLusy
 * @subpackage  EmailTools
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class EmailTools extends ServiceManager
{
    public function __construct(EmailToolsConfig $config)
    {
        $services = require __DIR__ . '/../../config/module.config.php';
        parent::__construct($services['service_manager']);

        $this->setService(EmailToolsConfig::class, $config);
    }
}
