<?php

$check = false;

$errorgpn = "";
if (empty($_COOKIE['username'])) {
    $errorgpn = "Login first!";
}
// Create connection
else {
    if (isset($_POST['creategroup'])) {

        if (empty($_POST['groupn'])) {
            $errorgpn = "Name should be provided!";
        } else {
            $gpname = $_POST['groupn'];
            $conn = new mysqli($servername, $usernamea, $password, $databasename);
            if ($conn->connect_error) {
                echo "Failed to connect!";
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT groupname from groupdata";

            $result = $conn->query($sql);
            if (!$result) {
                $ipl = "CREATE TABLE groupdata (
            groupname  VARCHAR(30) NOT NULL,
            username VARCHAR(30) NOT NULL,
            roleplay VARCHAR(30) NOT NULL,
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
                $sql = "INSERT INTO groupdata (groupname,username,roleplay) VALUES ('$gpname','$usnam','Admin')";

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
    if (isset($_POST['imgupload'])) {

        echo "<div id='gcimg' class='gc' style='visibility:visible'>
        <form method='post'>
        <h3 style='color:white'>" . $_POST['gnimg'] . "</h3>
        <h5 style='color:white'>To upload ur image go to Explore tab and upload your image with a uique name and added it here.</h5>
        <input hidden name='gpname' value='" . $_POST['gnimg'] . "'>
        <input placeholder='Image name' required name='imgname'>
        <button name='imguploadf'>Submit</button>
        </form>
        <button onclick='closeimg()'>Close</button>
        <script>
        function closeimg(){
            document.getElementById('gcimg').style.visibility='hidden';
        }
        </script>
        </div>";
    }
    if (isset($_POST['imguploadf'])) {
        echo "<h1>I am working</h1>";
        $conn = new mysqli($servername, $usernamea, $password, $databasename);
        if ($conn->connect_error) {
            echo "Failed to connect!";
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT img from groupdata";

        $result = $conn->query($sql);
        if (!$result) {
            $ipl = "ALTER TABLE groupdata
            ADD img varchar(255);";
            if ($conn->query($ipl) === TRUE) {
                echo "Table goupdata created successfully";
                echo "<script>Table created successful</script>";
            } else {
                echo "Error creating table: " . $conn->error;
            }
        }
        if ($_POST['imgname'] == "") {
            echo "<script>alert('image name should not be empty uplaod the image from explore tab!')</script>";
        } else {
            $imgname = $_POST['imgname'];
            $groupnameimg = $_POST['gpname'];
            $sql = "update groupdata set img='$imgname' WHERE groupname='$groupnameimg'";

            if ($conn->query($sql) === TRUE) {
                echo "Super successful";
            } else {
                echo "Small error!" . $conn->error;
            }
        }
        $conn->close();
    }
}
?>
<div id="gc" class="gc">
    <span class="cgtitle">New Group</span>
    <form action="" method="post">
        <span class="inputcard">
            <label for="groupn">Group Name :-</label>
            <input type="text" name="groupn" id="groupn" placeholder="Name">
            <span class="gcerror"><?php echo $errorgpn; ?></span>
        </span>
        <button class="cgcbtn" type="submit" name="creategroup">Create Group</button>
    </form>
    <button class="gcclose" onclick="closegroup()">Cancel</button>
</div>
<script>
    function closegroup() {
        document.getElementById('main').style.filter = 'blur(0px)';
        document.getElementById('gc').style.visibility = 'hidden';
    }
</script>
<?php
if (isset($_POST['creategroup'])) {
    echo "<script> document.getElementById('main').style.filter = 'blur(0px)';
    document.getElementById('gc').style.visibility = 'hidden';</script>";
}
?>