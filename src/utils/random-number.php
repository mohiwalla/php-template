<?php

function getRandomNumber(int $length = 6): string
{
    if ($length <= 0) {
        throw new InvalidArgumentException("Length must be a positive integer.");
    }

    $number = '';

    for ($i = 0; $i < $length; $i++) {
        $randomDigit = random_int(0, 9);
        $number .= $randomDigit;
    }

    return $number;
}
