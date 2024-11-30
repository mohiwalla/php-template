<?php

if ($isAdminRoute && !@$_SESSION['email']) {
    header("Location: /admin");
    exit;
}
