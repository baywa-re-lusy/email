<?php

/**
 * EmailAttachment.php
 *
 * @date      13.10.2021
 * @author    Pascal Paulis <pascal.paulis@baywa-re.com>
 * @file      EmailAttachment.php
 * @copyright Copyright (c) BayWa r.e. - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace BayWaReLusy\Email;

class EmailAttachment
{
    protected string $filename;
    protected string $data;

    /**
     * @param string $filename
     * @param string $data
     */
    public function __construct(string $filename, string $data)
    {
        $this->filename = $filename;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
}
