<?php

/**
 * Display a formatted view of one or more variables.
 *
 * This function takes any number of arguments and displays each one using
 * the `print_r` function wrapped in HTML `<pre>` tags for better readability
 * in a web browser. Each argument is output in a separate `<pre>` block.
 *
 * @param mixed ...$objects Any number of variables to be displayed. These can be of any type.
 *
 * @return void This function does not return any value.
 *
 * @example
 * // Display a single array
 * $array = [1, 2, 3];
 * display($array);
 *
 * @example
 * // Display multiple variables of different types
 * $array = [1, 2, 3];
 * $string = "Hello, World!";
 * $object = (object) ['key' => 'value'];
 * display($array, $string, $object);
 */
function display(...$objects)
{
    foreach ($objects as $obj) {
        echo "<pre>" . print_r($obj, true) . "</pre>";
    }
}

