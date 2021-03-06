BayWa r.e. Email Tools
======================

[![CircleCI](https://circleci.com/gh/baywa-re-lusy/email/tree/main.svg?style=svg)](https://circleci.com/gh/baywa-re-lusy/email/tree/main)

## Installation

To install the Email tools, you will need [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/email
```

## Usage

Currently, this library only supports Mailgun. However it uses an Adapter pattern to allow adding other vendors easily.

```php
use BayWaReLusy\EmailTools\EmailToolsConfig;
use BayWaReLusy\EmailTools\EmailTools;
use BayWaReLusy\EmailTools\EmailService;

$emailToolsConfig = new EmailToolsConfig('mailgun-api-key', 'mailgun-domain', 'https://api.eu.mailgun.net/');
$emailTools       = new EmailTools($emailToolsConfig);
$emailService     = $emailTools->get(EmailService::class);
$emailService->setAdapter($emailTools->get(MailgunAdapter::class));
```

Optionally, you can include then the Email Client into your Service Manager:

```php
$sm->setService(EmailTools::class, $emailTools);
```
