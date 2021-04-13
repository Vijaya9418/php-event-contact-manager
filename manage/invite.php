<?php

$check = false;

$errorgpn = "";
if (empty($_COOKIE['username'])) {
    $errorgpn = "Login first!";
}
// Create connection
else {
    if (isset($_POST['invitemem'])) {

        if (empty($_POST['groupn'])) {
            $errorgpn = "Name should be provided!";
        } else {
            $gpname = $_POST['groupn'];
            $conn = new mysqli($servername, $usernamea, $password, $databasename);
            if ($conn->connect_error) {
                echo "Failed to connect!";
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * from invitedata";

            $result = $conn->query($sql);
            if (!$result) {
                $ipl = "CREATE TABLE invitedata (
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

                $list = json_decode($_COOKIE['list']);
                var_dump($list);
                echo "<h1>We are good together!</h1>";

                $i = 0;
                echo count($list);
                while ($i < count($list)) {
                    $usnam = $list[$i];
                    $sql = "INSERT INTO invitedata (groupname,username,jstatus) VALUES ('$gpname','$usnam','invited')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Super successful";
                        $i += 1;
                    } else {
                        echo "Small error!" . $conn->error;
                    }
                }
                $conn->close();
            }
        }
    }
}
?>



<div id="ginvite" class="ginvite">
    <span class="cgtitle">Invite People</span>
    <span class="gnamek">Group Name:
        <p> <?php
            if (isset($_POST['addmembers'])) {
                echo $_POST['groupnamei'];
            }
            ?></p>
    </span>
    <form action="" method="post">
        <input name="groupn" type="text" hidden value="<?php
                                                        if (isset($_POST['addmembers'])) {
                                                            echo $_POST['groupnamei'];
                                                        }
                                                        ?>">
        <?php
        //check for already invided list
        $conn = new mysqli($servername, $usernamea, $password, $databasename);
        if ($conn->connect_error) {
            echo "Failed to connect!";
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * from invitedata";

        if ($result) {

            for ($iv = 0; $iv < count($users); $iv++) {
                $check = false;
                $checkstatus = false;
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if ($row['username'] == $users[$iv] && $row['groupname'] == $_POST['groupnamei']) {
                            if ($row['jstatus'] == 'joined') {
                                $checkstatus = true;
                            }
                            $check = true;
                        }
                    }
                }
                if ($checkstatus)
                    echo "<span class='usrscss'>" . $users[$iv] . "<img name=" . $users[$iv] . " id='imgtick" . $iv . "' src='./images/member.png'></span>";
                elseif ($check) {
                    echo "<span class='usrscss'>" . $users[$iv] . "<img name=" . $users[$iv] . " id='imgtick" . $iv . "' src='./images/wait.png'></span>";
                } else
                    echo "<span class='usrscss'>" . $users[$iv] . "<img name=" . $users[$iv] . " id='imgtick" . $iv . "' onclick='imagechange(this)' src='./images/checkbox.png'></span>";
            }
        } else {
            for ($iv = 0; $iv < count($users); $iv++) {
                echo "<span class='usrscss'>" . $users[$iv] . "<img name=" . $users[$iv] . " id='imgtick" . $iv . "' onclick='imagechange(this)' src='./images/checkbox.png'></span>";
            }
        }


        ?>
        <button class="cgcbtn" type="submit" name="invitemem">Invite</button>
    </form>
    <button class="gcclose" onclick="closed()">cancel</button>
</div>







<script>
    function closed() {
        document.getElementById('main').style.filter = 'blur(0px)';
        document.getElementById('ginvite').style.visibility = 'hidden';
    }

    var list = [];

    function imagechange(a) {
        // console.log(a);


        console.log(document.getElementById(a.id).src);
        if (!document.getElementById(a.id).src.endsWith('/images/tick.png')) {
            document.getElementById(a.id).src = './images/tick.png';
            list.push(a.name);

            setCookiel('list', JSON.stringify(list), 1);
        } else {
            document.getElementById(a.id).src = './images/checkbox.png';
            list = list.filter(i => i !== a.name);
            console.log(list);
            setCookiel('list', JSON.stringify(list), 1);
        }

    }

    function setCookiel(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
</script>
<?php
if (isset($_POST['invitemem'])) {

    echo "<script> document.getElementById('main').style.filter = 'blur(0px)';
    document.getElementById('ginvite').style.visibility = 'hidden';</script>";
}
?>