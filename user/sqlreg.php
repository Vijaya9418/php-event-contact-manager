<?php
$errors = ['empty_field' => ' ', 'first_name' => ' ', 'username' => '', 'pwd' => '', 'cpwd' => '', 'email' => '', 'age' => '', 'phone' => '', 'category' => ''];
$first_name = "";
$username = "";
$password = "";
$cpassword = "";
$email = "";
$phone_number = "";
$age = "";
$group = "";

//use Google\Cloud\Firestore\FirestoreClient;

//$path = '../key.json';
//require '../vendor/autoload.php';
if (isset($_POST['register'])) {
    $first_name = $_POST['fname'];
    $username = $_POST['username'];
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone'];
    $age = $_POST['age'];
    $group = $_POST['category'];
    $noerror = true;
    if (empty($first_name) ||  empty($username) || empty($password) || empty($cpassword) ||  empty($email) ||  empty($phone_number) || empty($age)) {
        //  echo "all fields are required";
        $noerror = false;
        $errors['empty_field'] = "all fields are required";
        echo $errors['empty_field'];
    }
    if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
        // echo "first name should be only in alphabets";
        $errors['first_name'] = "first name should be only in alphabets";
        $noerror = false;
    }
    if (!preg_match("/^[\w]*$/", $username)) {
        // echo "last name should be only in alphabets";
        $errors['username'] = "User naem can contain digits and alphabets only!";
        $noerror = false;
    }
    if (!preg_match("/^[0-9]{10}$/", $phone_number)) {
        // echo "phone number is inavlid";
        $noerror = false;
        $errors['phone'] = "phone number is inavlid";
    }
    if (!preg_match("/^.{5,}$/", $password)) {
        // echo "password is inavlid";
        $noerror = false;
        $errors['pwd'] = "Must be length greater than 5 and contain special char and a number ";
    }
    if ($password !== $cpassword) {
        // echo "password is inavlid";
        $noerror = false;
        $errors['cpwd'] = "password not matched";
    }
    if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/", $email)) {
        // echo "email is inavlid";
        $errors['email'] = "email is inavlid";
        $noerror = false;
    }
    if ($noerror) {
        $check = true;
        $servername = "localhost";
        $usernamea = "root";
        $passworda = "";

        // Create connection
        $conn = new mysqli($servername, $usernamea, $passworda, "logindata");
        if ($conn->connect_error) {
            echo "Failed to connect!";
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT username from userslog";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {

            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //echo "<script>console.log($row)</script>";
                // echo "username :" . $row['firstname'] . "<br>";
                if ($username === $row['username']) {
                    $check = false;
                }
            }
        } else {
            echo "0 results";
        }
        // Check connection


        if ($check) {
            // initialize();
            register();
            echo "Successful!";
            echo '<script>alert("Registered successfully")</script>';
        } else {
            $errors['username'] = "choose different username! , this one taken";
            echo $errors['username'];
        }
        //echo $errors;
        // echo "Registered successfully";
    }
    echo $errors['pwd'];
}




# [START fs_initialize]


/**
 * Initialize Cloud Firestore with default project ID.
 * ```
 * initialize();
 * ```
 */
function register()
{
    $servername = "localhost";
    $usernamea = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $usernamea, $password, "logindata");

    // Check connection
    if ($conn->connect_error) {
        echo "Failed to connect!";
        die("Connection failed: " . $conn->connect_error);
    }
    $firstname = $GLOBALS['first_name'];
    $username = $GLOBALS['username'];
    $age = $GLOBALS['age'];
    $password = $GLOBALS['password'];
    $group = $GLOBALS['group'];
    $phone = $GLOBALS['phone_number'];
    $email = $GLOBALS['email'];


    $sql = "INSERT INTO userslog (username,firstname,pwd,email,age,phone,groupp) VALUES ('$username','$firstname','$password','$email','$age','$phone','$group')";

    if ($conn->query($sql) === TRUE) {
        echo "Super successful";
    } else {
        echo "Small error!" . $conn->error;
    }
    $conn->close();
}
