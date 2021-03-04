<?php

$username = "";
$pwd = "";
$error = ['username' => '', 'pwd' => ''];

// use Google\Cloud\Firestore\FirestoreClient;

// $path = '../key.json';
// require '../vendor/autoload.php';

if (isset($_POST['logout'])) {
    function logout()
    {
        echo "<script>console.log('called" . time() . "')</script>";
        setcookie("name", "", -1, '/');
        setcookie("username", "", -3600, '/');
        header("Location: /event_manager/user/login.php");
    }
    logout();
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    if (empty($username) || empty($pwd)) {
        echo "<h1>All fields required!</h1>";
    } else {
        // $projectId = 'contact-stored';
        // echo "<script>console.log('working upto here');</script>";
        // try {
        //     $db = new FirestoreClient([
        //         'projectId' => $projectId,
        //         'keyFilePath' => $GLOBALS['path'],
        //     ]);
        // } catch (Exception $e) {
        //     echo "Error here" . $e;
        // }
        // try {
        //     $ref = $db->collection('users')->document('list');
        //     $snapshot = $db->collection('users')->document('list')->snapshot();
        //     $usernames = $snapshot->data();
        $check = false;

        $servername = "localhost";
        $usernamea = "root";
        $password = "";
        // Create connection
        $conn = new mysqli($servername, $usernamea, $password, "logindata");
        if ($conn->connect_error) {
            echo "Failed to connect!";
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT username from userslog";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //echo $row['username'];
                if ($username == $row['username']) {
                    $check = true;
                }
            }
        }

        //     foreach ($usernames['usernames'] as $name) {

        //         if ($name === $username) {
        //             $check = true;
        //          }
        //    }

        if ($check) {
            $sql = "SELECT pwd , firstname from userslog where username='$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    //echo "<script>console.log($row)</script>";
                    // echo "username :" . $row['firstname'] . "<br>";
                    if ($pwd === $row['pwd']) {
                        setcookie('username', $username, time() + (3600 * 24), "/");
                        setcookie('name', $row['firstname'], time() + 3600 * 24, "/");
                        $conn->close();
                        header("Location: /event_manager/index.php");
                    } else {
                        echo "Invalid Passowrd";
                        $error['pwd'] = "Invalid password!";
                        $conn->close();
                    }
                }
            }
            // $snapshot = $db->collection('users')->document($username)->snapshot();
            // $data = $snapshot->data();
            else {
                echo "Invalid Passowrd";
                $error['pwd'] = "Invalid password!";
                $conn->close();
            }
        } else {
            $error['username'] = "Invalid! ,Doesn't exists create one.";
        }
        // } catch (Exception $e) {
        //     echo "Error second here";
        //
    }
}

include('../nav/nav.php');
