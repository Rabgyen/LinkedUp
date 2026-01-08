<?php

    $server = "Localhost";
    $username = "root";
    $password = "";
    $dbname = "linkedup";

    $conn = mysqli_connect($server,$username,$password,$dbname);

    if(!$conn){
        die("Connection Failed");
    }

?>