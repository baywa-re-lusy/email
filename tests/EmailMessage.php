<?php

namespace BayWaReLusy\Email\Test;

use BayWaReLusy\Email\EmailAttachment;

class EmailMessage
{
    /** @var string[] */
    protected array $recipients = [];
    /** @var EmailAttachment[] */
    protected array $attachments = [];
    protected string $subject;
    protected bool $checked = false;

    /**
     * @return string[]
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @param string[] $recipients
     * @return EmailMessage
     */
    public function setRecipients(array $recipients): EmailMessage
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return EmailAttachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @param EmailAttachment[] $attachments
     * @return EmailMessage
     */
    public function setAttachments(array $attachments): EmailMessage
    {
        $this->attachments = $attachments;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return EmailMessage
     */
    public function setSubject(string $subject): EmailMessage
    {
        $this->subject = $subject;
        return $this;
    }
}
