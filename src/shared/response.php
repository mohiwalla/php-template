<?php

/**
 * Class Response: Used to send a JSON response to the client.
 * 
 * @param boolean $status
 * @param string $message
 * @param int $statusCode
 * @param array $additionalData
 * 
 * @return void
 */
class Response
{
	function __construct(bool $status, $message, int $statusCode = 200, $additionalData = [])
	{
		http_response_code($statusCode);
		header('Content-Type: application/json');

		$response = array_merge(['ok' => $status, 'text' => $message], $additionalData);
		echo json_encode($response);

		exit;
	}
}
