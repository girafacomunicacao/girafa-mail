<?php

namespace Girafa\Mail\Factory;

use Girafa\Mail\Factory\Exception\RuntimeException;
use Girafa\Mail\Service\MailgunService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MailgunServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (!isset($config['girafa_mail']['mailgun'])) {
            throw new RuntimeException(
                'Config for Mailgun is not set, did you copy config file into your config/autoload folder ?'
            );
        }

        $config  = $config['girafa_mail']['mailgun'];
        $service = new MailgunService($config['domain'], $config['key']);

        $client  = $serviceLocator->get('Girafa\Mail\Http\Client');
        $service->setClient($client);

        return $service;
    }
}
