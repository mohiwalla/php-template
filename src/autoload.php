<?php

header("X-Frame-Options: DENY");

$rawRoute = rtrim($_SERVER['REQUEST_URI'], "/");
$route = $rawRoute ?: "/";

require __DIR__ . "/lib/fetch.php";
require __DIR__ . "/shared/routes.php";
require __DIR__ . "/shared/response.php";
require __DIR__ . "/shared/display.php";
require __DIR__ . '/utils/get-ip.php';
require __DIR__ . "/shared/config.php";
require __DIR__ . "/shared/zod.php";
require __DIR__ . "/shared/db.php";
require __DIR__ . "/shared/middleware.php";
require __DIR__ . "/shared/admin-security.php";
