<?php
$check = false;

$servername = "localhost";
$usernamea = "root";
$password = "";
$errorgpn = "";

?>
<div id="gadd" class="gadd">
    <span class="cgtitle">Invite People</span>
    <form action="" method="post">


    </form>
    <button class="gcclose" onclick="closegadd()">cancel</button>
</div>
<script>
    function closegadd() {
        document.getElementById('main').style.filter = 'blur(0px)';
        document.getElementById('gadd').style.visibility = 'hidden';
    }
</script>
<?php
if (isset($_POST['addmembers'])) {
    echo "<script> document.getElementById('main').style.filter = 'blur(4px)';
    document.getElementById('gadd').style.visibility = 'visible';</script>";
}
?>
?>


<?php


if (empty($_COOKIE['username'])) {
    $errorgpn = "Login first!";
}
// Create connection
else {
    if (isset($_POST['invite'])) {

        if (empty($_POST['groupn'])) {
            $errorgpn = "Name should be provided!";
        } else {
            $gpname = $_POST['groupn'];
            $conn = new mysqli($servername, $usernamea, $password, "logindata");
            if ($conn->connect_error) {
                echo "Failed to connect!";
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * from invitedata";

            $result = $conn->query($sql);
            if (!$result) {
                $ipl = "CREATE TABLE groupdata (
            groupname  VARCHAR(30) NOT NULL,
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
            } else {
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        //echo $row['username'];
                        if ($gpname == $row['groupname']) {
                            $check = true;
                        }
                    }
                }
            }
            if (!$check) {
                $usnam = $_COOKIE['username'];
                $sql = "INSERT INTO groupdata (groupname,username,jstatus) VALUES ('$gpname','$usnam','invited')";

                if ($conn->query($sql) === TRUE) {
                    echo "Super successful";
                } else {
                    echo "Small error!" . $conn->error;
                }
                $conn->close();
            } else {
                $errorgpn = "Try different group name this one taken!";
            }
        }
    }
}
?>