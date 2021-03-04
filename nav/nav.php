<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="/nav.css" type="text/css" />
    <style>
        <?php
        include('nav.css')
        ?>
    </style>
</head>

<body>
    <nav>
        <a href="/event_manager/">Home</a>
        <a href="/event_manager/lay/events.php">Events</a>
        <a href="/event_manager/lay/groups.php">Groups</a>
        <a href="/event_manager/lay/explore.php">Explore</a>
        <input type="text" placeholder="search">
        <button>Search</button>
        <?php
        $name = "name";

        if (isset($_COOKIE[$name])) {
            echo  "<form class='formvi' method='post' action='/event_manager/user/login.php'> <button type='submit' name='logout' class='loginbtn'>Logout</button></form> <div class='namedis'>" . $_COOKIE['name'] . "</div>";
        } else {
            echo " <a href='/event_manager/user/login.php'> <button class='loginbtn'>Login</botton></a>";
        }
        ?>

    </nav>
</body>

</html>