<?php

/**
 * Perform a fetch request.
 *
 * @param string $url The URL where you want to send the fetch request.
 * @param array $options an array containing additional options for the request.
 * 	Supported options:
 *  	- method: The HTTP method (GET, POST, PUT, DELETE, etc.).
 *  	- headers: An associative array of custom headers.
 *  	- body: The request body data.
 *  	- timeout: Request timeout in seconds.
 *  	- ssl_verify: Whether to verify SSL certificates (default: false).
 * @return mixed The response from the fetch request.
 * @throws InvalidArgumentException If options are not an array or stdClass object.
 * @throws InvalidArgumentException If an invalid method is specified.
 * @throws RuntimeException If a cURL error occurs during the request.
 */
function fetch(string $url, array $options = [])
{
    $ch = curl_init();

    $defaults = [
        'method' => 'GET',
        'headers' => [],
        'body' => '',
        'timeout' => 30,
        'ssl_verify' => false,
    ];

    $options = (object) array_merge($defaults, $options);

    $method = strtoupper($options->method);
    if (!in_array($method, ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'HEAD'])) {
        throw new InvalidArgumentException('Invalid method specified.');
    }

    $headers = [];
    foreach ($options->headers as $key => $value) {
        $headers[] = $key . ': ' . $value;
    }

    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $method !== 'GET' ? $options->body : null,
        CURLOPT_TIMEOUT => $options->timeout,
        CURLOPT_SSL_VERIFYPEER => $options->ssl_verify,
        CURLOPT_RETURNTRANSFER => true,
    ]);

    $response = curl_exec($ch);
    if ($response === false) {
        throw new RuntimeException('cURL error: ' . curl_error($ch));
    }

    curl_close($ch);
    return $response;
}
