<?php

$isStaticRoute = str_starts_with($route, '/public/') || in_array($route, $rootFiles);

if ($isStaticRoute) {
    $filePath = __DIR__ . $route;
    require __DIR__ . '/../../src/lib/mime-types.php';

    if (file_exists($filePath)) {
        if (isset($mimeTypes[pathinfo($filePath, PATHINFO_EXTENSION)])) {
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $mimeType = $mimeTypes[$extension];
            
            header("Content-Type: $mimeType");
        }

        readfile($filePath);
        exit;
    }
}

$isAPIroute = str_starts_with($route, '/api/');

if ($isAPIroute) {
    $filePath = __DIR__ . '/../../src' . $route . '.php';

    if (file_exists($filePath)) {
        require $filePath;
        exit;
    }

    new Response(true, "We couldn't find the resource you're looking for.", 404);
    exit;
}

# just to demonstrate custom route handling logic
$isBlogPage = str_starts_with($route, "/blogs/");

if ($isBlogPage) {
    $routeParts = explode("/", $route);
    $blogID = array_pop($routeParts);

    if (!is_numeric($blogID)) {
        $blogID = -1;
    }
}

$isAdminRoute = str_starts_with($route, "/admin/");
