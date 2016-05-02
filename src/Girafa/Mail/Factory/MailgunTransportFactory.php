<?php

namespace Girafa\Mail\Factory;

use Girafa\Mail\Transport\HttpTransport;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MailgunTransportFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new HttpTransport($serviceLocator->get('Girafa\Mail\Service\MailgunService'));
    }
}
