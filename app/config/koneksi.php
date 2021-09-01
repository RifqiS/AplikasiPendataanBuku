<?php
    $server        = "localhost";
    $user          = "root";
    $password      = "";
    $nama_database = "uts_2113191031";
    $db = mysqli_connect($server, $user, $password, $nama_database);
    if (!$db) {
        die("Error" . mysqli_connect_error());
    }
?>