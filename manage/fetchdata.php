
<?php
$groups = array();
$groupsrole = array();
$users = array();
$gnocount = array();
$imgg = array();
if (empty($_COOKIE['username'])) {
    $errorgpn = "Login first!";
} else {
    $username = $_COOKIE['username'];
    $conn = new mysqli($servername, $usernamea, $password, $databasename);
    $sql = "SELECT * from groupdata";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo $row['username'];
            if (array_key_exists($row['groupname'], $gnocount)) {
                $gnocount[$row['groupname']] += 1;
            } else {
                $gnocount[$row['groupname']] = 1;
            }
            if ($username == $row['username']) {
                array_push($groups, $row['groupname']);
                array_push($groupsrole, $row['roleplay']);
                if (isset($row['img'])) {
                    $imgg[$row['groupname']] = $row['img'];
                }
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
