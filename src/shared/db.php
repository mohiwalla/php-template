<?php

if ($_ENV["DB_SERVER"] === "mssql") {
    require __DIR__ . "/database/mssql.php";
} else if ($_ENV["DB_SERVER"] === "mysql") {
    require __DIR__ . "/database/mysql.php";
}
