
jQuery(document).ready(function($) {
    // Asynchronous loop that runs once every second
    setInterval(function() {
        $.ajax({
            url: eyePAdmin.ajax_url,
            type: 'POST',
            data: {
                action: 'eye_p_fetch_data' // The WordPress AJAX hook
            },
            success: function(response) {
                // Check if the response is successful
                if (response.success) {
                    var table = "<table>";
                    table += "<tr><th>ID</th><th>IP</th><th>User ID</th><th>Date</th><th>Duration</th><th>Rating</th><th>Type</th><th>Geo</th><th>Human</th><th>User Agent</th><th>Registered</th><th>Accepted Terms</th><th>Is Euro</th><th>Visited URI</th></tr>";
                    $.each(response.data, function(i, item) {
                        table += "<tr>";
                        table += "<td>" + item.id + "</td>";
                        table += "<td>" + item.ip + "</td>";
                        table += "<td>" + item.userid + "</td>";
                        table += "<td>" + item.date + "</td>";
                        table += "<td>" + item.duration + "</td>";
                        table += "<td>" + item.rating + "</td>";
                        table += "<td>" + item.type + "</td>";
                        table += "<td>" + item.geo + "</td>";
                        table += "<td>" + item.human + "</td>"; // Added human column data
                        table += "<td>" + item.user_agent + "</td>"; // Added user_agent column data
                        table += "<td>" + item.registered + "</td>";
                        table += "<td>" + item.accepted_terms + "</td>";
                        table += "<td>" + item.is_euro + "</td>";
                        table += "<td>" + item.visited_uri + "</td>";
                        table += "</tr>";
                    });
                    table += "</table>";
                    $('#iplist').html(table);
                } else {
                    $('#iplist').html("No data found or an error occurred.");
                }
            }
        });
    }, 1000); // 1000 milliseconds = 1 second
});

