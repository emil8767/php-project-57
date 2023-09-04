<?php

use Rollbar\Rollbar;
use Rollbar\Payload\Level;

Rollbar::init(
    array(
        'access_token' => '0a3eb26b7c384e20bcd6beac1b4e1d50',
        'environment' => 'production'
    )
);


Rollbar::log(Level::info(), 'Test info message');
throw new Exception('Test exception');