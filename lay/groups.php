<?php
include('../nav/nav.php') ?>
<h1>Group Invites</h1>

<?php

$servername = "localhost";
$usernamea = "root";
$password = "";
$conn = new mysqli($servername, $usernamea, $password, "logindata");

if (isset($_POST['joininvite'])) {
    $usname = $_COOKIE['username'];
    $gname = $_POST['gname'];
    $sql = "UPDATE invitedata
SET jstatus='joined'
WHERE username='$usname'  and groupname='$gname' ";
    if ($conn->query($sql) === TRUE) {
        echo "Super successful joined group";
    } else {
        echo "Small error!" . $conn->error;
    }

    $sql = "INSERT INTO groupdata (groupname,username,roleplay) VALUES ('$gname','$usname','member')";

    if ($conn->query($sql) === TRUE) {
        echo ".";
    } else {
        echo "Small error unable to join group!" . $conn->error;
    }

    $conn->close();
}
if (isset($_POST['ignoreinvite'])) {
    $usname = $_COOKIE['username'];
    $gname = $_POST['gname'];
    $sql = "DELETE from  invitedata
WHERE username='$usname'  and groupname='$gname' ";
    if ($conn->query($sql) === TRUE) {
        echo "Super successful joined group";
    } else {
        echo "Small error!" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        <?php include('./groups.css') ?>
    </style>
    <title>Groups</title>
</head>

<body>

    <?php

    $check = false;

    $servername = "localhost";
    $usernamea = "root";
    $password = "";
    $errorgpn = "";


    $conn = new mysqli($servername, $usernamea, $password, "logindata");
    if ($conn->connect_error) {
        echo "Failed to connect!";
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * from invitedata";
    $result = $conn->query($sql);
    if (isset($_COOKIE['username'])) {
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if ($row['username'] == $_COOKIE['username'] && $row['jstatus'] == 'invited') {
                    echo  "<span class='inviteg'>" . $row['groupname'] . "
                    <form method='post'>
                    <input type='text' hidden value='" . $row['groupname'] . "' name='gname'>
                    <button name='joininvite' class='joininvite'> Join</button></form>
                    <form method='post'>
                    <input type='text' hidden value='" . $row['groupname'] . "' name='gname'>
                    <button name='ignoreinvite' class='ignoreinvite'>Ignore</button>
                    </form>
                    </span>";
                    $check = true;
                }
            }
        }
    } else {
        echo "<h2>Login First!</h2>";
    }
    ?>
</body>

</html>