<?php

# starting session if not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

# if IP is null then it's a development environment
define("DEV", GetIP() === null);

# error reporting enabled for development
ini_set('display_errors', DEV ? 1 : 0);
ini_set('display_startup_errors', DEV ? 1 : 0);
error_reporting(DEV ? -1 : 0);

# loading .env file
$envFilePath = __DIR__ . "/../../.env";
$_ENV = parse_ini_file($envFilePath); # overwriting super global $_ENV, maybe that's a bad idea, but who cares.. 🥲

# example variables, choose according to your project
const name = "Template";
const description = "A php starter template with built in routing";
const logo = "/public/images/logo.png";
