<?php

$zod = new zod();

$zod->field("email", $zod->email(), "Please enter a valid email.", "Email is required.")
    ->field("password", $zod->string(), "Please enter a valid password.", "Password is required.")
    ->field("password", $zod->minlength(8), "Password must be at least 8 characters long.");

$validationResult = $zod->parse($_POST);

if (!$validationResult->ok) {
    return new Response(false, $validationResult->error);
}

$data = $validationResult->data;
$_SESSION["email"] = $data->email;

return new Response(true, "You logged in successfully.");
