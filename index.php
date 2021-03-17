<?php
include('./nav/nav.php') ?>
<?php
include('./manage/fetchdata.php') ?>
<?php
include('./manage/eventfetch.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ev</title>
    <style>
        <?php include('./index.css') ?>
    </style>
</head>

<body>
    <div class="op" id="main">
        <h1>Home page</h1>

        <button class="mybtn1" onclick="cgop()">Create a group</button>
        <button class="mybtn2" onclick="ceop()">Add a Event</button>
        <button class="mybtn3">Post a message</button>

        <span class="indcard">
            <span class="events">New Events

                <span class="gpcard">
                    <?php
                    if (count($groups) == 0) {
                        echo "No events yet";
                    } else {
                        for ($iv = 0; $iv < count($eventd); $iv++) {
                            echo "<span class='gpcar'><img src='https://firebasestorage.googleapis.com/v0/b/reactelectronlearn.appspot.com/o/images%2F008ff400-bcde-428e-9364-1b80e4e34034.jpeg?alt=media&token=c6c01c82-40a2-40eb-8b7c-89175653c62d'>
                            <div class='bigbox'>
                            <div class='ntdis'><span class='gpname'>Event :" . $eventn[$iv] . "</span>
                            <span class='etime'> Time :" . $eventt[$iv] . "</span></div>
                            <div class='ntdis'><button class='join'>Join</button> 
                            <button class='notint'>Not Interested</button></div>
                            <div class='joinmem'>People Joined <img src='./images/members.png'>12</div>
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
                            <img src='https://firebasestorage.googleapis.com/v0/b/reactelectronlearn.appspot.com/o/images%2F008ff400-bcde-428e-9364-1b80e4e34034.jpeg?alt=media&token=c6c01c82-40a2-40eb-8b7c-89175653c62d'>
                            <div class='gimgside'>
                                <div class='grole'>" . $groupsrole[$iv] . "</div>
                                <div class='memdis'><img src='./images/members.png'>25</div>
                                <button type='submit' onclick='invite()' name='addmembers' class='addmem' ><img src='./images/addmem.png'></button>
                            </div>
                            <span class='gpname'>" . $groups[$iv] . "</span></div>";
                        }
                    }
                    ?>
                </span>
            </span>
        </span>
        <span class="posts">Posts here</span>
    </div>
    <?php include('./manage/eventdata.php') ?>
    <?php include('./manage/groupcreate.php') ?>
    <?php include('./manage/invite.php') ?>
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

    function invite() {
        document.getElementById('main').style.filter = 'blur(4px)';
        document.getElementById('ginvite').style.visibility = 'visible';
    }
</script>

</html>