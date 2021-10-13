<?php

use BayWaReLusy\Tools\Queue\EmailService;
use BayWaReLusy\EmailTools\Adapter\MailgunAdapter;
use BayWaReLusy\EmailTools\Adapter\MailgunAdapterFactory;

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                    EmailService::class
                ],
            'factories' =>
                [
                    MailgunAdapter::class => MailgunAdapterFactory::class,
                ],
            'abstract_factories' =>
                [
                ],
            'initializers' =>
                [
                ],
            'shared' =>
                [
                ]
        ]
];
