<?php
    $hostName = "https://d4man.github.io/elecdocon/";
    $userName = "root";
    $password = "";
    $databaseName = "propsal_management_system";
    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed due to: " . $conn->connect_error);
    }
?>