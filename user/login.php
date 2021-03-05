<?php
include('sqllogin.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        <?php include("style.css") ?>
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <br><br><br> <br><br><br>

    <div class="bgimage">
    <div class="row  justify-content-center">
   
        <div class='col-lg-6 align-self-center'>
      
            <div class="cardd text-white p-5">

                <div class="card-body">
                    <h4 class="form-text text-center">Signin</h4>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required type="text" value="<?php echo $username ?>" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="username">
                            <small style="color:red;" id="helpId" class="form-text text-warning"><?php echo $error['username'] ?></small>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input required type="password" value="<?php echo $pwd ?>" class="form-control" name="pwd" id="pwd" placeholder="password">
                            <small style="color:red;" id="helpId" class="form-text text-warning"><?php echo $error['pwd'] ?></small>
                        </div>
                        <button type="submit" name="login" class="btn btn-secondary">Login</button>
                    </form>
                </div>
            </div>
            <a href="/event_manager/user/reg.php" class="badge m-3   p-3  badge-warning reglink">Register</a>
        </div>
        </div>
    </div>
    </div>


</body>

</html>
<!--
-->