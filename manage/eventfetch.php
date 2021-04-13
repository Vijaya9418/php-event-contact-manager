<?php
$eventn = array();
$eventd = array();
$eventt = array();
$evento = array();
$status = array();
$eimgg = array();
if (empty($_COOKIE['username'])) {
    $errorgpn = "Login first!";
} else {
    $username = $_COOKIE['username'];
    $conn = new mysqli($servername, $usernamea, $password, $databasename);
    $sql = "SELECT * from eventdata";

    $result = $conn->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //echo $row['username'];
                for ($i = 0; $i < count($groups); $i++) {
                    if ($groups[$i] == $row['inv']) {
                        array_push($eventn, $row['eventname']);
                        array_push($eventd, $row['descriptions']);
                        array_push($eventt, $row['timesd']);
                        array_push($evento, $row['organisedby']);
                        if (isset($row['img'])) {
                            $eimgg[$row['eventname']] = $row['img'];
                        }
                    }
                }
                if ('Public' == $row['inv']) {
                    array_push($eventn, $row['eventname']);
                    array_push($eventd, $row['descriptions']);
                    array_push($eventt, $row['timesd']);
                    array_push($evento, $row['organisedby']);
                    if (isset($row['img'])) {
                        $eimgg[$row['eventname']] = $row['img'];
                    }
                }
            }
        }
    }
}
