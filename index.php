<?php
include('./database/creditionala.php');
include('./nav/nav.php') ?>
<?php
include('./manage/fetchdata.php') ?>
<?php
include('./manage/eventfetch.php') ?>
<?php
include('./eventmanage/eventmanage.php') ?>
<?php
include('./posts/postdata.php') ?>
<?php
include('./posts/postsfetch.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ev</title>
    <style>
        <?php include('./index.css') ?><?php include('./post.css') ?>
    </style>
</head>

<body>
    <div class="op" id="main">


        <button class="mybtn1" onclick="cgop()">Create a group</button>
        <button class="mybtn2" onclick="ceop()">Add a Event</button>
        <button class="mybtn3" onclick="post()">Post a message</button>

        <span class="indcard">
            <span class="events">New Events
                <span class="gpcard">
                    <?php
                    $conn = new mysqli($servername, $usernamea, $password, $databasename);
                    if (count($groups) == 0) {
                        echo "No events yet";
                    } else {
                        $usname = $_COOKIE['username'];
                        for ($iv = 0; $iv < count($eventd); $iv++) {

                            $sql = "SELECT * from eventdatalist where eventname='$eventn[$iv]' and username='$usname'";
                            $result = $conn->query($sql);

                            echo "
                            <span class='gpcar'>
                            <form method='post'>
                            <input hidden name='gnimg' value='" . $eventn[$iv] . "'>
                            <button name='imguploadevent'>
                            ";
                            if (isset($eimgg[$eventn[$iv]])) {
                                echo "
                                <img src='./upload/" . $eimgg[$eventn[$iv]] . "'>
                                ";
                            } else
                                echo "
                            <img src='https://firebasestorage.googleapis.com/v0/b/reactelectronlearn.appspot.com/o/images%2F008ff400-bcde-428e-9364-1b80e4e34034.jpeg?alt=media&token=c6c01c82-40a2-40eb-8b7c-89175653c62d'>
                            ";
                            echo "
                            </button>
                            </form>
                            <div class='bigbox'>
                            <div class='ntdis'><span class='gpname'>Event :" . $eventn[$iv] . "</span>
                            <span class='etime'> Time :" . $eventt[$iv] . "</span></div>
                            <div class='ntdis'>";
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['jstatus'] == 'joined') {
                                        echo "
                            
                            <input hidden name='eventname' value='" . $eventn[$iv] . "'>
                            <button name='joinevent' class='joined'>Joined</button> 
                            

                            <form method='post'> 
                            <input hidden name='eventname' value='" . $eventn[$iv] . "'>
                            <button name='editevent' class='edit'>Edit</button>
                            </form>";
                                    } else {
                                        echo "
                            
                            <input hidden name='eventname' value='" . $eventn[$iv] . "'>
                            <button name='joinevent' class='ignored'>Ignored</button> 
                         

                            <form method='post'> 
                            <input hidden name='eventname' value='" . $eventn[$iv] . "'>
                            <button name='editevent' class='edit'>Edit</button>
                            </form>";
                                    }
                                }
                            } else {
                                echo "
                            <form method='post'> 
                            <input hidden name='eventname' value='" . $eventn[$iv] . "'>
                            <button name='joinevent' class='join'>Join</button> 
                            </form>

                            <form method='post'> 
                            <input hidden name='eventname' value='" . $eventn[$iv] . "'>
                            <button name='ignoreevent' class='notint'>Not Interested</button>
                            </form>";
                            }
                            if ($evento[$iv] == $_COOKIE['username'])
                                echo "<form method='post'>
                                <input hidden name='eventname' value='" . $eventn[$iv] . "'> 
                            <button name='deleteevent' class='delete'>Delete</button></form>";
                            echo "
                            </div>
                            <div class='joinmem'>People Joined <img src='./images/members.png'>
                            ";
                            //count logic of group here
                            $sql = "SELECT * from eventdatalist where eventname='$eventn[$iv]'";
                            $result = $conn->query($sql);
                            $joined_count = 0;
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['jstatus'] == 'joined') {
                                        $joined_count += 1;
                                    }
                                }
                            }
                            echo $joined_count;
                            //count logic ends
                            echo "
                            </div>
                            </div>
                            
                            <span class='edec'> Details :" . $eventd[$iv] . "</span>
                            <span class='eorg'> Organised By :" . $evento[$iv] . "</span>
                            </span>";
                        }
                    }

                    ?>
                </span>
            </span>


            <span class="Groups">Groups
                <span class="gpcard">
                    <?php
                    if (count($groups) == 0) {
                        echo "Create a group or join a group";
                    } else {
                        for ($iv = 0; $iv < count($groups); $iv++) {
                            echo "<div class='gpcar'>
                            <form method='post'>
                            <input hidden name='gnimg' value='" . $groups[$iv] . "'>
                            <button name='imgupload'>
                            ";
                            if (isset($imgg[$groups[$iv]])) {
                                echo "
                                <img src='./upload/" . $imgg[$groups[$iv]] . "'>
                                ";
                            } else
                                echo "
                            <img src='https://firebasestorage.googleapis.com/v0/b/reactelectronlearn.appspot.com/o/images%2F008ff400-bcde-428e-9364-1b80e4e34034.jpeg?alt=media&token=c6c01c82-40a2-40eb-8b7c-89175653c62d'>
                            ";
                            echo "
                            </button>
                            </form>
                            <div class='gimgside'>
                                <div class='grole'>" . $groupsrole[$iv] . "</div>
                                <div class='memdis'><img src='./images/members.png'>" . $gnocount[$groups[$iv]] . "</div>
                            <form method='post'>  

                            <input hidden name='groupnamei' value='" . $groups[$iv] . "' >
                              <button type='submit' id='" . $groups[$iv] . "'   name='addmembers' class='addmem' ><img src='./images/addmem.png'></button>
                              </form>
                            </div>
                            <span class='gpname'>" . $groups[$iv] . "</span></div>";
                        }
                    }
                    ?>
                </span>
            </span>
        </span>
        <span class="posts">Posts here
            <div>
                <?php
                for ($iv = 0; $iv < count($pdtitle); $iv++) {
                    $check = false;
                    for ($i = 0; $i < count($groups); $i++) {
                        if ($groups[$i] == $pdgroup[$iv]) {
                            $check = true;
                        }
                    }
                    if ($check) {
                        echo "<form method='post'>
                    <input name='datano' hidden value='" . $iv . "'>
                    <button name='postdisplay'><div class='postcard'><span class='title'>" . $pdtitle[$iv] . "</span>
                <span class='dec'>" . substr($pddata[$iv], 0, 30) . "</span>
                <span class='auth'>Auth: " . $pdgname[$iv] . "</span>
                <span class='pgroup'>Group: " . $pdgroup[$iv] . "</span>
                <span class='pdate'>" . $pddate[$iv] . "</span></div></button></form>
                ";
                    }
                }
                ?></div>

        </span>
    </div>




    <?php include('./manage/eventdata.php') ?>
    <?php include('./manage/groupcreate.php') ?>



    <?php include('./manage/invite.php') ?>
    <?php
    include('./posts/postswrite.php') ?>
</body>

<script>
    function cgop() {
        document.getElementById('main').style.filter = 'blur(4px)';
        document.getElementById('gc').style.visibility = 'visible';

    }

    function ceop() {
        document.getElementById('main').style.filter = 'blur(4px)';
        document.getElementById('ge').style.visibility = 'visible';
    }

    function post() {
        document.getElementById('main').style.filter = 'blur(5px)';
        document.getElementById('gpost').style.visibility = 'visible';
    }
</script>

<?php
if (isset($_POST['addmembers'])) {

    echo "<script>
    document.getElementById('main').style.filter = 'blur(4px)';
        document.getElementById('ginvite').style.visibility = 'visible';
    </script>";
}
?>

</html>