<?php
use GeoIp2\Database\Reader;
function log_page_visit_to_db() {
    global $wpdb; // This gives us access to the WordPress database object


// Adjust the path to where you've saved the GeoLite2 database
    $databaseFile = EYE_P_PLUGIN_DIR . 'vendor/GeoLite2/GeoLite2-City.mmdb';

    $reader = new Reader($databaseFile);

    $userAgent = $_SERVER['HTTP_USER_AGENT'];

// A list of common bot user agent substrings
    $bots = array('googlebot', 'bingbot', 'slurp', 'webcrawler', 'duckduckgo', 'baiduspider', 'yandex', 'sogou' , 'amazonbot', 'spider' , 'mvisionplayer', 'bot' );

    $isBot = false;
    $human = 'Human';
    foreach ($bots as $bot) {
        if (stripos($userAgent, $bot) !== false) {
            $isBot = true;
            $human = $bot;
            break; // No need to continue the loop if a bot is found
        }
    }
    $Rating = 0;
    if ($isBot) {
        // Logic for when the user agent is a bot
        $Rating = -1;
    } else {
        // Logic for when the user agent is probably a real user
        $Rating = 0;
    }



    // Construct table name with WordPress prefix
    $table_name = $wpdb->prefix . 'eye_p';

    // Get the user ID if the user is logged in, or set to 'guest' otherwise
    $user_id = is_user_logged_in() ? get_current_user_id() : 'guest';
    // Check the type of URI being requested
    $uri = $_SERVER['REQUEST_URI'];
    $type = 'page_visit'; // Default type

// Regular expression to check for asset files like .js, .css, .map, etc.
    if (preg_match('/\.(js|css|map|jpg|jpeg|png|gif|svg|ico|woff|woff2|ttf|eot)$/', $uri)) {
        $type = 'asset_call';
    } elseif (substr($uri, -1) === '/' || basename(parse_url($uri, PHP_URL_PATH)) == 'wp-login.php') {
        $type = 'endpoint';
    }


    // Check if the IP address is localhost (::1 or 127.0.0.1) and replace it with a placeholder
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($ip === '::1' || $ip === '127.0.0.1') {
        $ip = '96.232.128.49'; // Placeholder IP
    }
    $record = $reader->city($ip);

    $geo =  $record->city->name . ", " .$record->subdivisions[0]->name . " " . $record->country->name;
    // Prepare the data for insertion
    $data = [
        'ip' => $ip,
        'userid' => $user_id,
        'date' => current_time('mysql'),
        // Assuming you have mechanisms to set these or they are set to default values
        'duration' => '00:00:00', // Placeholder value, adjust as necessary
        'rating' => $Rating, // Placeholder value
        'type' => $type, // Placeholder or determined value
        'geo' => $geo, // Placeholder or determined value
        'registered' => is_user_logged_in() ? 1 : 0,
        'accepted_terms' => 0, // Placeholder or determined value
        'is_euro' => 0, // Placeholder or determined value
        'other' => '', // Placeholder or determined value, needs to be blob-compatible
        'visited_uri' => $_SERVER['REQUEST_URI'],
        'human' => $human,
        'user_agent' => $userAgent,
    ];

    $format = ['%s', '%s', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%d', '%s', '%s','%s','%s']; // Format for each field

    // Insert the data into the database
    $wpdb->insert($table_name, $data, $format);
}


