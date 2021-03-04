<?php
$servername = "localhost";
$username = "root";
$password = "";
$new = new mysqli($servername, $username, $password);
if ($new->connect_error) {
    echo "Failed to connect!";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "<h1>Success I like this</h1>";
    $sql = "CREATE DATABASE logindata";
    if ($new->query($sql) === TRUE) {
        echo "Database created successfully";


        // Create connection
        $conn = new mysqli($servername, $username, $password, "logindata");
        if ($conn->connect_error) {
            echo "Failed to connect!";
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "CREATE TABLE userslog (
            username  VARCHAR(30) PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            pwd VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            age VARCHAR(50),
            phone VARCHAR(50),
           
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            groupp VARCHAR(30)
            )";
        //$sql = "ALTER TABLE userslog add  groupp VARCHAR(30)";
        if ($conn->query($sql) === TRUE) {
            echo "Table MyGuests created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        echo "Error creating database: " . $conn->error;
    }
}
