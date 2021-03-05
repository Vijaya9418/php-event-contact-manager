<?php
$servername = "sql204.epizy.com";
$username = "epiz_28059391";
$password = "ivjbXJRfXtODP";

// Create connection
$conn = new mysqli($servername, $username, $password, "epiz_28059391_logindata");
if ($conn->connect_error) {
    echo "Failed to connect!";
    echo "Vijaykanth reddy";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "successful!";
}
