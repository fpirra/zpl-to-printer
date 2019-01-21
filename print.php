<?php

// Check if the form is submitted
if ( isset( $_POST['submit'] ) ) {
    $req_ip = $_REQUEST['ip'];
    $req_port = $_REQUEST['port'];
    $req_zpl = $_REQUEST['zpl'];
} else {
    exit;
}

error_reporting(E_ALL);

/* Get the port for the service. */
$port = $req_port;

/* Get the IP address for the target host. */
$host = $req_ip;

/* construct the label */
$label = $req_zpl;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error    ()) . "\n";
} else {
    echo "OK.\n";
}

echo "Attempting to connect to '$host' on port '$port'...";

$result = socket_connect($socket, $host, $port);

if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror    (socket_last_error($socket)) . "\n";
} else {
    echo "OK.\n";
}

socket_write($socket, $label, strlen($label));
socket_close($socket);
?>