<?php

namespace BayWaReLusy\Email\Test;

class EmailService extends \BayWaReLusy\Email\EmailService
{
    public function __construct()
    {
    }

    public static function getTempEmailStorageFile(): string
    {
        return sys_get_temp_dir() . '/sent-emails';
    }

    public function sendMessage(
        array $to,
        string $subject,
        string $message,
        ?string $template = null,
        array $variables = [],
        array $attachments = [],
        array $cc = [],
        bool $sendAsHtml = false
    ): void {
        $message = new EmailMessage();
        $message
            ->setRecipients($to)
            ->setAttachments($attachments)
            ->setSubject($subject);

        file_put_contents(
            self::getTempEmailStorageFile(),
            base64_encode(serialize($message)) . "\n",
            FILE_APPEND
        );
    }
}
