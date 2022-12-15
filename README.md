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

### Twilio SendGrid
```php
use BayWaReLusy\Email\Adapter\SendgridAdapter;
use BayWaReLusy\Email\EmailService;

$adapter      = new SendgridAdapter('sendgrid-api-key', 'sendgrid-domain');
$emailService = new EmailService($adapter);
```
