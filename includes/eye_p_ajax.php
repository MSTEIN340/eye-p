<?php
function eye_p_log_ip_ajax() {
    if (isset($_POST["ip"])) {
        write_ip($_POST["ip"]);
        $response = array('ip' => "My IP Address Is: " . $_POST["ip"]);
        echo json_encode($response);
        wp_die(); // This is important to terminate immediately and return a proper response
    }
}

function write_ip($ip)
{

}

function eye_p_fetch_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'eye_p';  // Use the correct prefix

    // Query to fetch the most recent 50 records of type 'endpoint' from the eye_p table
    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE type = %s ORDER BY date DESC LIMIT 50",
            'endpoint'
        ),
        ARRAY_A
    );

    if (empty($results)) {
        // Use wp_send_json_error to send a JSON response with an error status
        wp_send_json_error('No data found');
    } else {
        // Use wp_send_json_success to send a JSON response with a success status
        wp_send_json_success($results);
    }
    // No need to call wp_die() because wp_send_json_success/wp_send_json_error already includes it
}




/*
// cURL request to call WhoIs API

// POST METHOD
<?php
// The API endpoint you're trying to reach
$url = "http://example.com/api/data";

// Data you want to send, encoded as JSON
$data = json_encode(array("key" => "value"));

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options for POST request
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set HTTP Header for POST request
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data))
);

// Execute cURL session and store the response
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Decode the response
$responseData = json_decode($response, true);

// Check the result
print_r($responseData);
?>


// GET METHOD
<?php
// The API endpoint you're trying to reach
$url = "http://example.com/api/data";

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url); // Set the URL for the GET request
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the transfer as a string
curl_setopt($ch, CURLOPT_HEADER, 0); // Don't include the header in the output

// Execute cURL session and store the response
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Use the API response - for example, decode a JSON response
$responseData = json_decode($response, true);

// Check the result
print_r($responseData);
?>





 */