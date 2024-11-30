<?php

require __DIR__ . '/src/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="/public/js/script.js"></script>

    <title><?= @$pageTitles[$route] ? $pageTitles[$route] . ' - ' . name : name ?>
    </title>
</head>

<body class="dark">
    <div class="fixed z-[500] backdrop-blur bg-black w-screen h-screen opacity-35 place-items-center hidden"
        id="global-loader">
        <img src="/public/images/loader.gif" class="w-32 pointer-events-none" draggable="false" alt>
    </div>

    <?php

    if ($isAdminRoute) {
        require $_SERVER['DOCUMENT_ROOT'] . '/src/includes/admin-header.php';
    } else {
        require $_SERVER['DOCUMENT_ROOT'] . '/src/includes/header.php';
    }

    $filePath = __DIR__ . '/src/app' . ($routeOverrides[$route] ?? $route) . '.php';

    ?>

    <main>
        <?php

        if (file_exists($filePath)) {
            require $filePath;
        } else if ($isBlogPage) {
            require __DIR__ . "/src/app/blog.php";
        } else {
            require __DIR__ . '/src/app/errors/404.php';
        }

        ?>
    </main>

    <script src="/public/js/post-script.js"></script>
</body>

</html>