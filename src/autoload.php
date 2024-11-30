<?php

header("X-Frame-Options: DENY");
$route = @$_SERVER['PATH_INFO'] ? str_ends_with($_SERVER['PATH_INFO'], "/") ? substr($_SERVER['PATH_INFO'], 0, -1) : $_SERVER['PATH_INFO'] : "/";

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
