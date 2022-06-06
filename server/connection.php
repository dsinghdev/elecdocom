<?php
    //  $hostName = "localhost";
    //  $userName = "root";
    //  $password = "";
    // $databaseName = "propsal_management_system";

    //remote db conn.
     $hostName = "remotemysql.com";
     $userName = "ADWeeGgUDv";
     $password = "QTl2AVs5Xg";
    $databaseName = "ADWeeGgUDv";

    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    if ($conn->connect_error) {
        die("Connection failed due to: " . $conn->connect_error);
    }
?>