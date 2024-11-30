<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

# loading .env file
$envFile = __DIR__ . '/../../.env';
$env = file_get_contents($envFile);
$lines = explode("\n", $env);

foreach ($lines as $line) {
    if (preg_match("/([^#]+)\=(.*)/", $line, $matches)) {
        putenv($line);
    }
}

const name = 'Template';
const description = 'A php starter template with built in routing';
const logo = '/public/images/logo.png';
