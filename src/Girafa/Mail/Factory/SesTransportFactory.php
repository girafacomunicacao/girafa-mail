<?php

namespace Girafa\Mail\Factory;

use Girafa\Mail\Transport\SesTransport;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SesTransportFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SesTransport($serviceLocator->get('Aws\Sdk')->createClient('Ses'));
    }
}
