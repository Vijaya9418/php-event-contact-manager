<?php

$check = false;

$servername = "localhost";
$usernamea = "root";
$password = "";
$errorevn = "";
$errordec = "";
$errordate = "";
if (empty($_COOKIE['username'])) {
    $errorevn = "Login first!";
}
// Create connection
else {
    if (isset($_POST['createevent'])) {

        if (empty($_POST['eventn'])) {
            $errorevn = "Name should be provided!";
        } else if (empty($_POST['eventdec'])) {
            $errordec = "Some details should be menctioned!";
        } else if (empty($_POST['eventdate'])) {
            $errordate = "date and time should be selected";
        } else {
            $eventname = $_POST['eventn'];
            $eventdec = $_POST['eventdec'];
            $eventdate = $_POST['eventdate'];
            $conn = new mysqli($servername, $usernamea, $password, "logindata");
            if ($conn->connect_error) {
                echo "Failed to connect!";
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * from eventdata";

            $result = $conn->query($sql);
            if (!$result) {
                $ipl = "CREATE TABLE eventdata (
            eventname  VARCHAR(30) NOT NULL,
            descriptions VARCHAR(30) NOT NULL,
            timesd DATETIME NOT NULL,
            organisedby VARCHAR(30),
            inv VARCHAR(30),
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
                        if ($eventname == $row['eventname']) {
                            $check = true;
                        }
                    }
                }
            }
            if (!$check) {
                $inv = $_POST['eventinv'];
                if (empty($_POST['orgby']))
                    $usnam = $_POST['orgby'];
                else
                    $usnam = $_COOKIE['username'];
                $sql = "INSERT INTO eventdata (eventname,descriptions,timesd,organisedby,inv) VALUES ('$eventname','$eventdec','$eventdate','$usnam','$inv')";

                if ($conn->query($sql) === TRUE) {
                    echo "Super successful";
                } else {
                    echo "Small error!" . $conn->error;
                }

                echo "<script> document.getElementById('main').style.filter = 'blur(0px)';
                    document.getElementById('ge').style.visibility = 'hidden';</script>";

                $conn->close();
            } else {
                $errorevn = "Try a little different event name this one exists it may confuse.";
            }
        }
    }

    if (isset($_POST['imguploadevent'])) {

        echo "<div id='gcimg' class='gc' style='visibility:visible'>
        <form method='post'>
        <h3 style='color:white'>" . $_POST['gnimg'] . "</h3>
        <h5 style='color:white'>To upload ur image go to Explore tab and upload your image with a uique name and added it here.</h5>
        <input hidden name='gpname' value='" . $_POST['gnimg'] . "'>
        <input placeholder='Image name' required name='imgname'>
        <button name='imguploadeventf'>Submit</button>
        </form>
        <button onclick='closeimg()'>Close</button>
        <script>
        function closeimg(){
            document.getElementById('gcimg').style.visibility='hidden';
        }
        </script>
        </div>";
    }
    if (isset($_POST['imguploadeventf'])) {
        echo "<h1>I am working</h1>";
        $conn = new mysqli($servername, $usernamea, $password, "logindata");
        if ($conn->connect_error) {
            echo "Failed to connect!";
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT img from eventdata";

        $result = $conn->query($sql);
        if (!$result) {
            $ipl = "ALTER TABLE eventdata
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
            $sql = "update eventdata set img='$imgname' WHERE eventname='$groupnameimg'";

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

<div id="ge" class="ge">
    <span class="cgtitle">New Event</span>
    <span class="ecerror"><?php echo $errorevn; ?></span>
    <form action="" method="post">
        <div class="formsize">
            <span class="inputcard" style="display: inline-block;">
                <label for="eventn">Event Name</label>
                <input type="text" name="eventn" id="eventn" placeholder="Name">

            </span>
            <span class="inputcard" style="display: inline-block;">
                <label for="eventdate">Date</label>
                <input type='datetime-local' name="eventdate" id="eventdate" placeholder="select date">
                <span class="ecerror"><?php echo $errordate; ?></span>
            </span>

            <span class="inputcard">
                <label for="eventdec">Details</label>
                <textarea name="eventdec" id="eventdec" placeholder="Event details"></textarea>
                <span class="ecerror"><?php echo $errordec; ?></span>
            </span>



            <span class="inputcard" style="display: inline-block;">
                <label for="eventn">Organisded By</label>
                <input readonly type="text" value='<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>' name="orgby" id="orgby" placeholder="Name">

            </span>

            <span class="inputcard" style="display: inline-block;">
                <label for="eventinv">Invities</label>
                <select required multiple name="eventinv" id="eventinv">
                    <option value="Public">Public</option>
                </select>
            </span>
        </div>
        <button class="cgcbtn" type="submit" name="createevent">Create Event</button>
    </form>
    <button class="gcclose" onclick="closede()">cancle</button>
</div>
<script>
    //  console.log("fine");
    var select = document.getElementById("eventinv");

    <?php
    for ($i = 0; $i < count($groups); $i++) {
        echo  "var opt=document.createElement('option');opt.value = '" . $groups[$i] . "';opt.innerHTML = '" . $groups[$i] . "';select.appendChild(opt);";
    }
    ?>
    //echo "select.options[" . $i . "] = new Option('" . $groups[$i] . "');";
    //document.createElement('option');
    //  opt.value = i;
    //opt.innerHTML = i;
    //select.appendChild(opt);
    //   console.log(groups);

    function closede() {
        document.getElementById('main').style.filter = 'blur(0px)';
        document.getElementById('ge').style.visibility = 'hidden';
    }
</script>