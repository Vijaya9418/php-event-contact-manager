<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add post</title>
</head>

<body>
    <div id="gpost" class="gpost">
        <div class="fhalf">
            <form method="post">

                <span class="titile"> Title <?php if ($errorp['ptitle'] != '') echo "<span class='error'>" . $errorp['ptitle'] . "</span>"; ?></span>
                <input placeholder="head" name='ptitle' type="text" value="<?php echo $ptitle; ?>">
                <textarea placeholder="Write HTML here in will be rendered on our left " oninput="framechange()" name="pcontent" id="content" cols="30" rows="10"><?php echo $pcontent; ?></textarea>


                <?php if ($errorp['pcontent'] != '') echo "<span class='error'>" . $errorp['pcontent'] . "</span>"; ?>
                <div class="pview">
                    <label for="eventinv">To</label>
                    <select required name="pgroup" id="pgroup">
                        <option value="Public">Public</option>
                    </select>
                </div>
                <button class="postadd" name="postadd">Post</button>
            </form>
            <button onclick="closepost()" class="postclose" name="postclose">Close</button>
        </div>
        <div class="shalf">
            <iframe id="FileFrame" src="about:blank" frameborder="1">

            </iframe>
        </div>
    </div>
</body>

<script>
    var content = document.getElementById('content');

    function framechange() {
        var doc = document.getElementById('FileFrame').contentWindow.document;
        doc.open();
        console.log('called')
        console.log(content.value)
        doc.write(content.value);
        doc.close();
    }

    function closepost() {
        document.getElementById('main').style.filter = 'blur(0px)';
        document.getElementById('gpost').style.visibility = 'hidden';
    }
</script>

<script>
    var selectp = document.getElementById("pgroup");
    <?php
    for ($i = 0; $i < count($groups); $i++) {
        echo  "opt=document.createElement('option');
        opt.value = '" . $groups[$i] . "';
        opt.innerHTML = '" . $groups[$i] . "';
        selectp.appendChild(opt);";
    }
    if (isset($_POST['postadd'])) {
        echo "<script> document.getElementById('main').style.filter = 'blur(0px)';
        document.getElementById('gpost').style.visibility = 'hidden';</script>";
    }
    ?>
</script>

</html>