<?php

return [
    // Literal assertions: Check that $_SERVER[$key] === $value
    'headers' => [
        // Need to generate one? Here's a quick command to do it:
        // $ php -r 'echo bin2hex(random_bytes(64));'
        'HTTP_X_AUTHORIZATION' => 'api key here',
    ],
    // Path to the directory where files should be stored.
    'uploadDir' => __DIR__ . '/../images/',
    // URL where this project ("public") lives.
    'baseUrl' => 'https://example.org',
    // URL Where the images ("uploadDir") lives.
    'cdnUrl' => 'https://example.org/images',
    // ShareX sends the file name as the window it is recognized, enabling this might be a slight
    // privacy risk at expense of knowing what you're clicking on when you link this image.
    // If using this option, ensure ShareX's file naming is set to "%pn_%y-%mo-%d_%h-%mi-%s" or something else starting
    // with "%pn_"
    'useAppNamePrefix' => true,
    // Create an identically named file on the cdn with .json extension that contains metadata. Exposes information
    // to the public you might not want. You could reject access with your webserver config, or just set this to false.
    'writeJsonMetadata' => true,
];
