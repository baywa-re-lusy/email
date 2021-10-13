BayWa r.e. Email Tools
======================

## Installation

To install the Email tools, you will need to be using [Composer](http://getcomposer.org/) in your project:

```bash
composer require baywa-re-lusy/email
```

## Usage

Currently, this library only supports Mailgun. However it uses an Adapter pattern to allow adding other vendors easily.

```php
use BayWaReLusy\EmailTools\EmailToolsConfig;
use BayWaReLusy\EmailTools\EmailTools;

$emailToolsConfig = new EmailToolsConfig('mailgun-api-key');
$emailTools       = new EmailTools($emailToolsConfig);
```

Optionally, you can include then the Email Client into your Service Manager:

```php
$sm->setService(EmailTools::class, $emailTools);
```
