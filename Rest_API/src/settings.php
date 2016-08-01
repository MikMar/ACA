<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        'db' => [
            'host' => '46.101.89.217',
            'user' => 'root',
            'pass' => 'CCrk4yVDI8',
            'dbname' => 'mikayel',
],
    ],
];
