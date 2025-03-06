BayWa r.e. Email Tools
======================

[![CircleCI](https://circleci.com/gh/baywa-re-lusy/email/tree/main.svg?style=svg)](https://circleci.com/gh/baywa-re-lusy/email/tree/main)

## Installation

To install the Email tools, you will need [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/email
```

## Usage

Currently, this library supports MailGun and SendGrid.

### MailGun
```php
use BayWaReLusy\Email\Adapter\MailgunAdapter;
use BayWaReLusy\Email\EmailService;

$adapter      = new MailgunAdapter('mailgun-api-key', 'mailgun-domain', 'https://api.eu.mailgun.net/');
$emailService = new EmailService($adapter);
```

### AWS SES
```php
use BayWaReLusy\Email\Adapter\AwsAdapter;
use BayWaReLusy\Email\EmailService;

$adapter      = new AwsAdapter('aws-key', 'aws-secret', 'aws-region', 'domain');
$emailService = new EmailService($adapter);
```

## Tests

The avoid sending emails during acceptance tests, but to still test that emails are sent, there is a mock EmailService
(which inherits from the real EmailService) and an Email context.

To use the mock EmailService, you can replace the original EmailService in testing mode (e.g. in `Module.php`) :

```php
if (getenv('ENV') === 'testing') {
    $config->merge(new Config(include __DIR__ . '/../../../tests/mocks.config.php'));
}
```

And in `mocks.config.php` :

```php
<?php

return
    [
        'service_manager' =>
            [
                'invokables' =>
                    [
                        \BayWaReLusy\Email\EmailService::class => \BayWaReLusy\Email\Test\EmailService::class,
                    ],
                    ...
            ],
    ];

```
