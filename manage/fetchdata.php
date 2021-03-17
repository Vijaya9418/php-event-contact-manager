<?php
$servername = "localhost";
$usernamea = "root";
$password = "";
$groups = array();
$groupsrole = array();
$users = array();
if (empty($_COOKIE['username'])) {
    $errorgpn = "Login first!";
} else {
    $username = $_COOKIE['username'];
    $conn = new mysqli($servername, $usernamea, $password, "logindata");
    $sql = "SELECT * from groupdata";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo $row['username'];

            if ($username == $row['username']) {
                array_push($groups, $row['groupname']);
                array_push($groupsrole, $row['roleplay']);
            }
        }
    }

    $sqlk = "SELECT username from userslog";
    $result = $conn->query($sqlk);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo $row['username'];
            array_push($users, $row['username']);
        }
    }
}
