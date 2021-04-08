<?php
$servername = "localhost";
$usernamea = "root";
$password = "";

$conn = new mysqli($servername, $usernamea, $password, "logindata");
if ($conn->connect_error) {
    echo "Failed to connect!";
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * from postdata";

$result = $conn->query($sql);
if (!$result) {
    $ipl = "CREATE TABLE postdata (
title  VARCHAR(30) NOT NULL,
username VARCHAR(30) NOT NULL,
content VARCHAR(5000) NOT NULL,
gname VARCHAR(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
    if ($conn->query($ipl) === TRUE) {
        echo "Table goupdata created successfully";
        echo "<script>Table created successful</script>";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}
$ptitle = '';
$pcontent = '';
$pgroup = '';

$errorp = ['ptitle' => '', 'pcontent' => '', 'pgroup' => ''];

if (isset($_COOKIE['username'])) {

    $usname = $_COOKIE['username'];
    if (isset($_POST['postadd'])) {
        $allgood = true;
        if (!isset($_POST['ptitle'])) {

            $errorp['ptitle'] = 'Titile is compulsory!';
            $allgood = false;
        } else {
            $ptitle = $_POST['ptitle'];

            $sql = "SELECT * from postdata";
            $result = $conn->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if ($row['title'] == $ptitle) {
                            $allgood = false;
                            $errorp['ptitle'] = 'Try different Title already exists!';
                        }
                    }
                }
            }
        }
        if (!isset($_POST['pcontent'])) {
            $errorp['pcontent'] = 'Enter some content';
            $allgood = false;
        } else {
            $pcontent = $_POST['pcontent'];
        }
        if (!isset($_POST['pgroup'])) {
            $errorp['pgroup'] = 'Select a group or public!';
            $allgood = false;
        }
        if ($allgood) {
            $usname = $_COOKIE['username'];
            $ptitle = $_POST['ptitle'];
            $pcontent = $_POST['pcontent'];
            $pgroup = $_POST['pgroup'];
            $sql = "INSERT INTO postdata (title,username,content,gname) VALUES ('$ptitle','$usname','$pcontent','$pgroup')";
            if ($conn->query($sql) === TRUE) {
                echo "Super successful joined group";
            } else {
                echo "Small error!" . $conn->error;
            }
        }
    }

    if (isset($_POST['deletepost'])) {
        $usname = $_COOKIE['username'];
        $titlek = $_POST['postvalue'];
        $sql = "DELETE from  postdata
WHERE title='$titlek'  and username='$usname' ";
        if ($conn->query($sql) === TRUE) {
            echo "Super successful deleted event";
        } else {
            echo "Small error!" . $conn->error;
        }
    }
}
$conn->close();
