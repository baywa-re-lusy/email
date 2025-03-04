<?php

namespace BayWaReLusy\Email\Test;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;

class EmailContext implements Context
{
    /**
     * @Then the following email should have been sent:
     */
    public function theEmailContentShouldMatch(TableNode $table): void
    {
        if (!file_exists(EmailService::getTempEmailStorageFile())) {
            throw new \Exception('No emails have been sent.');
        }

        /** @var EmailMessage[] $emails */
        $emails = [];

        foreach (file(EmailService::getTempEmailStorageFile()) as $serializedEmail) {
            $emails[] = unserialize(base64_decode($serializedEmail));
        }

        $found = false;

        foreach ($emails as $email) {
            $recipientsMatch  = false;
            $subjectMatch     = false;
            $attachmentsMatch = false;

            foreach ($table->getRows() as $property) {
                if ($property[0] === 'recipients') {
                    $recipients = explode(',', $property[1]);
                    $messageRecipients = $email->getRecipients();

                    sort($recipients);
                    sort($messageRecipients);

                    if ($recipients === $messageRecipients) {
                        $recipientsMatch = true;
                    }
                } elseif ($property[0] === 'subject') {
                    if ($property[1] === $email->getSubject()) {
                        $subjectMatch = true;
                    }
                } elseif ($property[0] === 'attachments') {
                    $attachments = explode(',', $property[1]);
                    $messageAttachments = [];

                    foreach ($email->getAttachments() as $attachment) {
                        $messageAttachments[] = $attachment->getFilename();
                    }

                    sort($attachments);
                    sort($messageAttachments);

                    if ($attachments === $messageAttachments) {
                        $attachmentsMatch = true;
                    }
                }
            }

            if ($recipientsMatch && $attachmentsMatch && $subjectMatch) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            throw new \Exception("Didn't find a matching email.");
        }
    }

    /**
     * @Then exactly :emailCount emails should have been sent
     */
    public function exactlyEmailsShouldHaveBeenSent(int $emailCount): void
    {
        $emails = file(EmailService::getTempEmailStorageFile());

        if (!is_array($emails)) {
            throw new \Exception('No emails found.');
        }

        if (count($emails) !== $emailCount) {
            throw new \Exception(sprintf('Expected %d emails, got %d.', $emailCount, count($emails)));
        }
    }

    /**
     * @Then no email should have been sent
     */
    public function noEmailShouldHaveBeenSent(): void
    {
        if (
            file_exists(EmailService::getTempEmailStorageFile()) &&
            !empty(file(EmailService::getTempEmailStorageFile()))
        ) {
            throw new \Exception('No email should have been sent.');
        }
    }
}
