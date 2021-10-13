<?php
/**
 * MailgunAdapterFactory.php
 *
 * @date      13.10.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      MailgunAdapterFactory.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\EmailTools\Adapter;

use BayWaReLusy\EmailTools\EmailToolsConfig;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class MailgunAdapterFactory
 *
 * @package     BayWaReLusy
 * @author      Pascal Paulis <pascal.paulis@baywa-re.com>
 * @copyright   Copyright (c) BayWa r.e. - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class MailgunAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var EmailToolsConfig $config */
        $config = $container->get(EmailToolsConfig::class);

        return new MailgunAdapter($config->getMailgunApiKey());
    }
}
