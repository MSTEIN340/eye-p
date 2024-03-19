
let user_ip = "";

window.onload = function() {
    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            Eye_P_Log_IP(data.ip);
            console.log("IP",data.ip);
            user_ip = data.ip;
        })
        .catch(error => {
            console.error('Error fetching IP:', error);
            document.getElementById('ip-address').textContent = 'Unavailable';
        });
};
/*
window.addEventListener('beforeunload', function(event) {
    var data = { ip: user_ip, action2: 'leaving' };
    var blob = new Blob([JSON.stringify(data)], {type : 'application/json'});

    var payload = new FormData();
    payload.append('ip', user_ip);  // Use the IP address captured by PHP
    payload.append('action2', 'leaving');
    payload.append('action', 'leaving');
    // Loop through entries for debugging
    for (let [key, value] of payload.entries()) {
        console.log(`${key}: ${value}`);
    }
    console.log('ajax',eyepBlockData.ajax_url);
    console.log('pluginUrl',eyepBlockData.pluginUrl);
    let endpoint = eyepBlockData.pluginUrl + 'leaving.php';
   // console.log("endpoint",(endpoint));
    console.log("payload",(payload));
//    navigator.sendBeacon(endpoint, payload);
 //  navigator.sendBeacon(endpoint, blob);
    for(let i=1; i<5000; i++ ){
        console.log("hey");
    }

});
*/
window.addEventListener('beforeunload', function(event) {
    let currentPageUrl = window.location.href;
    const data = new URLSearchParams({
        'currentPageUrl': currentPageUrl,
        'action': 'handle_leaving', // This should match the action hooks in PHP
        'ip': user_ip
    });
    console.log(currentPageUrl);
    fetch(eyepBlockData.ajax_url, {
        method: 'POST',
        body: data,
        keepalive: true // For requests during page unload
    });
});

function Eye_P_Log_IP(eyep) {
    console.log("Log IP");
    let xhr = new XMLHttpRequest();
    xhr.open('POST', eyepBlockData.ajax_url , true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    xhr.onload = function() {
        if (this.status >= 200 && this.status < 400) {
            var response = JSON.parse(this.response);
            var htmlContent = response.ip;
            var ipDiv = document.getElementById('ipDiv');
            if (ipDiv) {
                ipDiv.innerHTML = htmlContent; // Assuming response is the HTML content you want to insert
                console.log(htmlContent);
            }
        } else {
            console.error("Server reached, but it returned an error");
        }
    };

    // Handling errors
    xhr.onerror = function() {
        // There was a connection error of some sort
        console.error("Failed to send request");
    };

    // Sending the request
    xhr.send('action=eye_p_log_ip_ajax&nonce=' + eyepBlockData.nonce + '&ip=' + eyep);
}




