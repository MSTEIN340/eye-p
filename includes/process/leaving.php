<?php

function handle_leaving_action() {
    // Make sure to check the nonce for security if using one
    // check_ajax_referer('my_nonce');
  //  echo "attempting to write";
    // Assuming the IP and action are sent in the request
    $ip = isset($_POST['ip']) ? sanitize_text_field($_POST['ip']) : '';
    $action = isset($_POST['action']) ? sanitize_text_field($_POST['action']) : '';
    $currentPageUrl =isset($_POST['currentPageUrl']) ? sanitize_text_field($_POST['currentPageUrl']) : '';
//    $currentPageUrl = ''; // You need to ensure this variable is assigned a value securely

    // Example of fetching the current page URL securely (on the server-side)
    if (isset($_SERVER['HTTP_REFERER'])) {
        // Get the full URL from HTTP_REFERER
        $fullUrl = esc_url_raw($_SERVER['HTTP_REFERER']);

        // Parse the URL to extract components
        $parsedUrl = parse_url($fullUrl);

        // Build the path, including the query string if it exists
        $currentPageUrl = $parsedUrl['path'] . (isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '');

    }
    ?>
    <script>
        console.log(<?php echo json_encode($currentPageUrl); ?>);
        for(let i=1; i<5000; i++ ){
            console.log("hey");
        }
    </script>


    <?php

    if ($action === 'handle_leaving' && !empty($ip)) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'eye_p';
        // $ip="::1";
        // Find the most recent record for the given IP
        $latestRecord = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE ip = %s AND visited_uri= %s ORDER BY date DESC LIMIT 1",
            $ip,$currentPageUrl
        ));
        /*
        $latestRecord = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE ip = %s ORDER BY date DESC LIMIT 1",
            $ip
        ));
        */
        if ($latestRecord) {
            // Calculate the duration
            $startTime = new DateTime($latestRecord->date);
            $endTime = new DateTime(); // Now
            $duration = $startTime->diff($endTime)->format('%H:%I:%S'); // duration in HH:MM:SS format

            // Update the record with the duration
            $wpdb->update(
                $table_name,
                [
                    'duration' => $duration,
                    'visited_uri' => $currentPageUrl // Update the visited_uri with the new URL
                ],
                ['id' => $latestRecord->id] // WHERE condition
            );
        }
    }
    wp_die(); // End the execution to return proper response
}


/*
function handle_leaving_action()
{

    $input = file_get_contents('php://input');

//parse_str($input, $parsed_input);
    $parsed_input = json_decode($input, true);

    if (isset($parsed_input['action']) && $parsed_input['action'] === 'leaving') {
        $action = $parsed_input['action'];
        $ip = $parsed_input['ip'];
// Example endpoint: /path-to-endpoint/index.php
        echo "INSIDE LEAVING!";
        // die();

        //  if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'eye_p';


        // Checking for the most recent record for this IP


        // Find the most recent record for the given IP
        $latestRecord = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE ip = %s ORDER BY date DESC LIMIT 1",
            $ip
        ));

        if ($latestRecord) {
            // Calculate the duration
            $startTime = new DateTime($latestRecord->date);
            $endTime = new DateTime(); // Now
            $duration = $startTime->diff($endTime);

            // Update the record with the duration
            $wpdb->update(
                $table_name,
                ['duration' => $duration->format('%H:%I:%S')], // duration in HH:MM:SS format
                ['id' => $latestRecord->id] // WHERE condition
            );
            wp_die();

        }
    } else {
        echo $_POST["action"];
    }
}
*/