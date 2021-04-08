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
$pdgname = array();
$pdtitle = array();
$pddata = array();
$pddate = array();
$pdgroup = array();
$result = $conn->query($sql);
if ($result) {
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo $row['username'];
            array_push($pdtitle, $row['title'],);
            array_push($pdgname, $row['username']);
            array_push($pddata, $row['content']);
            array_push($pdgroup, $row['gname']);
            array_push($pddate, $row['reg_date']);
        }
    }
}
?>
<html>
<div id="dpost" class="dpost">
    <div onclick="disclose()" class="closepostdis">Close</div>
    <div class="authdis">Auth: <?php if (isset($_POST['postdisplay'])) echo $pdgname[$_POST['datano']]; ?> </div>

    <div class="dishead" id="dposthead"></div>
    <div class="contentdisplay">
        <?php if (isset($_POST['postdisplay'])) echo $pddata[$_POST['datano']]; ?>
    </div>
    <div class="groupdis">Group: <?php if (isset($_POST['postdisplay'])) echo $pdgroup[$_POST['datano']]; ?></div>
    <div class="datedis">
        <?php if (isset($_POST['postdisplay'])) echo $pddate[$_POST['datano']]; ?>
    </div>
    <?php if (isset($_POST['postdisplay'])) {
        if ($pdgname[$_POST['datano']] == $_COOKIE['username']) {
            echo "<form method='post'>
        <input hidden name='postvalue' value='" . $pdtitle[$_POST['datano']] . "'>
        <button name='deletepost' class='deletepost'>Delete</button></form>";
        }
    } ?>
</div>

</html>
<script>
    function disclose() {
        document.getElementById('dpost').style.visibility = 'hidden';
        document.getElementById('main').style.filter = 'blur(0px)';
    }
</script>
<?php
if (isset($_POST['postdisplay'])) {

    echo "<script>
    console.log('asdjfla thisis working')
        document.getElementById('dpost').style.visibility = 'visible';
        document.getElementById('main').style.filter = 'blur(15px)';
    
        </script>
";
}
?>