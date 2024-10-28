<?php

// Define constants
define('TIMEOUT', 10); // Set a default timeout for cURL requests
define('TG_CHATID', 'YOUR_TELEGRAM_CHAT_ID'); // Replace with your Telegram chat ID
define('TG_BOT_TOKEN', 'YOUR_TELEGRAM_BOT_TOKEN'); // Replace with your Telegram bot token
define('GOOGLE_PROXY', 'https://script.google.com/macros/s/YOUR_GOOGLE_SCRIPT_URL/exec'); // Replace with your Google Apps Script URL

/**
 * Check the uptime of provided URLs.
 *
 * @param array $urls An array of URLs to check.
 */
function checkUptime($urls)
{
    foreach ($urls as $url) {
        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt_array($ch, [
            CURLOPT_URL => $url, // URL to check
            CURLOPT_RETURNTRANSFER => true, // Return response as a string
            CURLOPT_ENCODING => "", // Handle all encodings
            CURLOPT_MAXREDIRS => 10, // Maximum number of redirects to follow
            CURLOPT_TIMEOUT => 30, // Timeout in seconds
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // Use HTTP 1.1
            CURLOPT_CUSTOMREQUEST => "GET", // Use GET method
            CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification for testing (not recommended for production)
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', // User agent string
            CURLOPT_FOLLOWLOCATION => true, // Follow redirects
        ]);

        // Execute the request
        $response = curl_exec($ch); // Execute cURL request
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP response status code
        $errorMessage = curl_error($ch); // Capture any error message

        // Handle errors and status codes
        if ($errorMessage) {
            sendNotification($url, null, $errorMessage); // Notify if there's an error
        } elseif ($statusCode !== 200) {
            sendNotification($url, $statusCode); // Notify if status code is not 200 (OK)
        } else {
            echo "Website $url is up with status code: $statusCode\n"; // Optional success message
        }

        // Close cURL session
        curl_close($ch);
    }
}

/**
 * Send notification about the website status.
 *
 * @param string $url The URL that was checked.
 * @param int|null $statusCode The HTTP status code returned.
 * @param string|null $errorMessage The error message if any occurred.
 */
function sendNotification($url, $statusCode, $errorMessage = null)
{
    // Prepare Telegram message
    $telegramMessage = $errorMessage
        ? "🚨 Error checking $url: $errorMessage"
        : "🚨 Alert: The website $url is down.";

    // Prepare parameters for Google Apps Script
    $params = [
        'message' => $telegramMessage,
        'botToken'  =>  TG_BOT_TOKEN, // Use dummy bot token
        'chatId' => TG_CHATID, // Use dummy chat ID
    ];

    // Initialize cURL session for Telegram notification
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, GOOGLE_PROXY . '?' . http_build_query($params)); // Set the URL for Google Apps Script
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout for the request
    curl_exec($ch); // Execute the request
    curl_close($ch); // Close cURL session
}

// List of URLs to check
$urls = [
    'https://www.example1.com', // Replace with actual URLs
    'https://www.example2.com', // Replace with actual URLs
    'https://www.example3.com', // Replace with actual URLs
    'https://www.example4.com'  // Replace with actual URLs
];

// Check the uptime for the listed URLs
checkUptime($urls);
