<?php

return array(
    'service_manager' => array(
        'factories' => array(
        	/**
             * Transport
             */
            'Girafa\Mail\Transport\MailgunTransport' => 'Girafa\Mail\Factory\MailgunTransportFactory',
            'Girafa\Mail\Transport\SesTransport'     => 'Girafa\Mail\Factory\SesTransportFactory',

            /**
             * Services
             */
            'Girafa\Mail\Service\MailgunService'     => 'Girafa\Mail\Factory\MailgunServiceFactory',

            /**
             * HTTP client
             */
            'Girafa\Mail\Http\Client' => 'Girafa\Mail\Factory\HttpClientFactory',
        ),
    ),

    'girafa_mail' => array(
        'mailgun' => array(
            /**
             * Set your Mailgun domain name (eg. mydomain.com)
             */
            // 'domain' => '',

            /**
             * Set your Mailgun API key
             */
            // 'key' => ''

            /**
             * Skip TLS Verification
             */
            //'skip-verification' => true,

            /**
             * Your SMTP credentials
             */
            //'smtp' => array(
            //    'port'     => 587,
            //    'username' => '',
            //    'password' => '',
            //)
        ),

        'http_adapter' => 'Zend\Http\Client\Adapter\Socket',
    )
);
