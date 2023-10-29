<?php
require 'vendor/autoload.php'; 

// Replace these with your MongoDB Atlas connection details
$mongoURI = "mongodb+srv://naveensingh7604:naveensingh7604@cluster0.wq1gytd.mongodb.net/guvi";

try {
    $client = new MongoDB\Client($mongoURI);
    $collection = $client->guvi->test; // Replace with your database and collection name

    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Read the JSON data from the request body
        $requestBody = file_get_contents('php://input');
        $data = json_decode($requestBody, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            // Insert the data into MongoDB
            $collection->insertOne($data);

            echo "Data inserted successfully.";
        } else {
            echo "Invalid JSON data in the request body.";
        }
    } else {
        echo "This script only handles POST requests.";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "MongoDB Error: " . $e->getMessage();
}
?>