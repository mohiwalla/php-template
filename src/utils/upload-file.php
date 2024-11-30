<?php

function uploadFile($fileName, $file, $uploadDirectory) {
    $baseName = $fileName . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    $filePath = $uploadDirectory . $baseName;

    $uploaded = move_uploaded_file($file['tmp_name'], $filePath);

    if ($uploaded) {
        return $baseName;
    }

    return false;
}
