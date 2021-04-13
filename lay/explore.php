<?php
include('../nav/nav.php') ?>

<div class="back">
<div class="imageup">

<?php
$target_dir = "../upload/";


// Check if image file is a actual image or fake image


if (isset($_POST["submitimg"])) {

    if (isset($_FILES["fileToUpload"])) {

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        echo "<h1>Uplaoding</h1>";
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                echo "<h1>" . $_FILES["fileToUpload"]["name"] . "</h1>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>
</div>
<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submitimg">
</form>
<?php
include('../posts/postsfetch.php') ?>
<?php
include('../manage/fetchdata.php') ?>
<style>
    <?php include('../index.css') ?><?php include('../post.css') ?>
</style>

<span class="posts"><h4>Posts here</h4>
    <div>
        <?php
        for ($iv = 0; $iv < count($pdtitle); $iv++) {
            $check = false;
            for ($i = 0; $i < count($groups); $i++) {
                if ($groups[$i] == $pdgroup[$iv]) {
                    $check = true;
                }
            }
            if (!$check) {
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
        ?>
        
    </div>

</span>
</div>