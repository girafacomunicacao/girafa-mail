<?php

namespace Girafa\Mail\Factory;

use Zend\Http\Client as HttpClient;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HttpClientFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        $client = new HttpClient();
        $client->setAdapter($config['girafa_mail']['http_adapter']);

        if (isset($config['girafa_mail']['http_options'])) {
            $client->getAdapter()->setOptions($config['girafa_mail']['http_options']);
        }

        return $client;
    }
}
