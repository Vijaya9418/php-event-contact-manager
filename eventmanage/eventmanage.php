<?php
$conn = new mysqli($servername, $usernamea, $password, $databasename);
if ($conn->connect_error) {
    echo "Failed to connect!";
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * from eventdatalist";

$result = $conn->query($sql);
if (!$result) {
    $ipl = "CREATE TABLE eventdatalist (
eventname  VARCHAR(30) NOT NULL,
username VARCHAR(30) NOT NULL,
jstatus VARCHAR(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
    if ($conn->query($ipl) === TRUE) {
        echo "Table goupdata created successfully";
        echo "<script>Table created successful</script>";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}


if (isset($_POST['joinevent'])) {
    $usname = $_COOKIE['username'];
    $gname = $_POST['eventname'];
    $sql = "INSERT INTO eventdatalist (eventname,username,jstatus) VALUES ('$gname','$usname','joined')";
    if ($conn->query($sql) === TRUE) {
        echo "Super successful joined group";
    } else {
        echo "Small error!" . $conn->error;
    }
}
if (isset($_POST['ignoreevent'])) {
    $usname = $_COOKIE['username'];
    $gname = $_POST['eventname'];
    $sql = "INSERT INTO eventdatalist (eventname,username,jstatus) VALUES ('$gname','$usname','ignored')";
    if ($conn->query($sql) === TRUE) {
        echo "Super successful joined group";
    } else {
        echo "Small error!" . $conn->error;
    }
}
if (isset($_POST['deleteevent'])) {
    $usname = $_COOKIE['username'];
    $ename = $_POST['eventname'];
    $sql = "DELETE from  eventdata
WHERE organisedby='$usname'  and eventname='$ename' ";
    if ($conn->query($sql) === TRUE) {
        echo "Super successful deleted event";
    } else {
        echo "Small error!" . $conn->error;
    }
}
if (isset($_POST['editevent'])) {
    $usname = $_COOKIE['username'];
    $ename = $_POST['eventname'];
    $sql = "DELETE from  eventdatalist
WHERE username='$usname'  and eventname='$ename' ";
    if ($conn->query($sql) === TRUE) {
        echo "Super successful deleted event";
    } else {
        echo "Small error!" . $conn->error;
    }
}
$conn->close();
