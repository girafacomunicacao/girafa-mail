<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'Girafa\Mail\Transport\SesTransport' => 'Girafa\Mail\Factory\SesTransportFactory',
        ),
    ),
);
