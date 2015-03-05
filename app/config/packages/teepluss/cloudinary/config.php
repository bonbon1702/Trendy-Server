<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Cloudinary API configuration
    |--------------------------------------------------------------------------
    |
    | Before using Cloudinary you need to register and get some detail
    | to fill in below, please visit cloudinary.com.
    |
    */

    'cloudName'  => 'danpj76kz',
    'baseUrl'    => 'http://res.cloudinary.com/danpj76kz',
    'secureUrl'  => 'https://res.cloudinary.com/danpj76kz',
    'apiBaseUrl' => 'https://api.cloudinary.com/v1_1/danpj76kz',
    'apiKey'     => '478168121449761',
    'apiSecret'  => '99pbYpmuisgIaU8EE8J9hdDfmYg',

    /*
    |--------------------------------------------------------------------------
    | Default image scaling to show.
    |--------------------------------------------------------------------------
    |
    | If you not pass options parameter to Cloudy::show the default
    | will be replaced.
    |
    */

    'scaling'    => array(
        'format' => 'png',
        'width'  => 150,
        'height' => 150,
        'crop'   => 'fit',
        'effect' => null
    )

);
