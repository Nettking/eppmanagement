<?php

// Set the endpoint URL
$url = 'https://api.norid.no/domenenavn/api/whois';

// Set the query parameters
$params = array(
  'query' => 'example.no'
);

// Build the query string
$query = http_build_query($params);

// Send the request
$response = file_get_contents($url . '?' . $query);

// Decode the JSON response
$data = json_decode($response, true);

// Print the response
print_r($data);


