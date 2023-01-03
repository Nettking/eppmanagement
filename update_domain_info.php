<?php

// Replace YOUR_API_KEY with your actual API key
$apiKey = 'YOUR_API_KEY';

// Set the domain you want to modify
$domain = 'example.no';

// Set the new registrant for the domain
$registrant = 'new-registrant-handle';

// Set up the API endpoint URL and HTTP headers for the update API call
$endpoint = 'https://api.norid.no/domain/update';
$headers = [
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
];

// Build the POST data for the API call
$data = [
    'domain' => $domain,
    'registrant' => $registrant
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

// Close the cURL handle
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Check the response for success or failure
if ($responseData['success']) {
    // The domain was successfully updated
    echo "The domain $domain was successfully updated!";
} else {
    // There was an error updating the domain
    echo "Error updating domain: " . $responseData['error'];
}
