<?php

// Replace YOUR_API_KEY with your actual API key
$apiKey = 'YOUR_API_KEY';

// Set the domain you want to check
$domain = 'example.no';

// Set up the API endpoint URL and HTTP headers for the availability check API call
$endpoint = 'https://api.norid.no/domain/check';
$headers = [
    'Accept: application/json',
    'Authorization: Bearer ' . $apiKey
];

// Build the POST data for the API call
$data = [
    'domain' => $domain
];

// Initialize cURL and set the options
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the API call and get the response
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    exit;
}

// Close the cURL handle
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Check the availability of the domain
if ($responseData['available']) {
    // The domain is available, so we can try to register it
    
    // Set up the API endpoint URL and HTTP headers for the registration API call
    $endpoint = 'https://api.norid.no/domain/create';
    $headers = [
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ];

    // Build the POST data for the API call
    $data = [
        'domain' => $domain,
        'period' => 1, // 1 year
        'registrant' => 'your-registrant-handle'
    ];

    // Initialize cURL and set the options
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the API call and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        echo 'Error: ' . curl_error($ch);
        exit;
    }

