<?php
    // php_server, username, password, database_name
    $connection = mysqli_connect("localhost", "root", "aswink", "hotel");

    if(!connection)
    {
        die("Connection failed!");
    }
?>